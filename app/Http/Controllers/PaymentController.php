<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class PaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = config('services.midtrans.is_sanitized');
        Config::$is3ds = config('services.midtrans.is_3ds');
    }

    public function pay(Booking $booking)
    {
        // Check if payment exists and is valid
        $existingPayment = Payment::where('booking_id', $booking->id)
            ->where('payment_status', 'pending')
            ->first();

        if ($existingPayment && $existingPayment->snap_token) {
            return response()->json(['snap_token' => $existingPayment->snap_token]);
        }

        $transaction_id = 'TRX-' . $booking->booking_code . '-' . time();

        $params = [
            'transaction_details' => [
                'order_id' => $transaction_id,
                'gross_amount' => (int) $booking->total_price,
            ],
            'customer_details' => [
                'first_name' => $booking->user->name,
                'email' => $booking->user->email,
                'phone' => $booking->user->phone,
            ],
            'item_details' => [
                [
                    'id' => $booking->package->id,
                    'price' => (int) $booking->package->price,
                    'quantity' => $booking->total_passengers,
                    'name' => $booking->package->name,
                ]
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);

            Payment::create([
                'booking_id' => $booking->id,
                'amount' => $booking->total_price,
                'payment_gateway' => 'midtrans',
                'transaction_id' => $transaction_id,
                'payment_status' => 'pending',
                'snap_token' => $snapToken,
            ]);

            return response()->json(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            Log::error('Midtrans Error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function notification(Request $request)
    {
        try {
            $notif = new Notification();
        } catch (\Exception $e) {
            Log::error('Midtrans Notification Error: ' . $e->getMessage());
            return response()->json(['message' => 'Notification Error'], 500);
        }

        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $order_id = $notif->order_id;
        $fraud = $notif->fraud_status;

        $payment = Payment::where('transaction_id', $order_id)->first();

        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        if ($transaction == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $payment->update(['payment_status' => 'pending']);
                } else {
                    $payment->update(['payment_status' => 'success']);
                }
            }
        } else if ($transaction == 'settlement') {
            $payment->update(['payment_status' => 'success']);
        } else if ($transaction == 'pending') {
            $payment->update(['payment_status' => 'pending']);
        } else if ($transaction == 'deny') {
            $payment->update(['payment_status' => 'failed']);
        } else if ($transaction == 'expire') {
            $payment->update(['payment_status' => 'expire']);
        } else if ($transaction == 'cancel') {
            $payment->update(['payment_status' => 'cancel']);
        }

        // Update Booking Status based on Payment Status
        if ($payment->payment_status === 'success') {
            $payment->booking->update([
                'status' => 'confirmed',
                'payment_status' => 'paid',
            ]);
        } elseif (in_array($payment->payment_status, ['failed', 'expire', 'cancel'])) {
            $payment->booking->update([
                'status' => 'cancelled', // Or keep pending? Let's cancel for now.
                'payment_status' => 'failed',
            ]);
        }

        return response()->json(['message' => 'Video notification processed']);
    }
}
