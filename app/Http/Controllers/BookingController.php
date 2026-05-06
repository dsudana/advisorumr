<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Package;
use App\Models\Lead;
use App\Models\ConversionEvent;
use App\Jobs\SendAbandonedBookingReminder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'package_id' => 'required|exists:packages,id',
            'total_passengers' => 'required|integer|min:1',
            'departure_date' => 'nullable|date',
        ]);

        $package = Package::findOrFail($validated['package_id']);

        $basePrice = $package->price;
        $totalPrice = $basePrice * $validated['total_passengers'];

        $booking = Booking::create([
            'name' => $validated['name'],
            'phone_number' => $validated['phone_number'],
            'email' => $validated['email'] ?? null,
            'whatsapp_number' => $validated['phone_number'], // Assume same number initially
            'package_id' => $validated['package_id'],
            'departure_date' => $validated['departure_date'] ?? null,
            'booking_date' => now(),
            'total_passengers' => $validated['total_passengers'],
            'base_price' => $basePrice,
            'total_price' => $totalPrice,
            'status' => 'pending',
            'payment_status' => 'pending',
            'booking_code' => 'B-' . strtoupper(Str::random(8)),
            'notes' => 'Booking via Website',
        ]);

        // Track conversion event
        ConversionEvent::track(
            ConversionEvent::EVENT_BOOKING_INITIATED,
            'booking_created',
            [
                'booking_id' => $booking->id,
                'value' => $totalPrice,
                'page_url' => $request->url(),
                'session_id' => session()->getId(),
            ]
        );

        // Create or update lead from booking
        if ($validated['email']) {
            $lead = Lead::firstOrCreate(
                ['email' => $validated['email']],
                [
                    'first_name' => explode(' ', $validated['name'])[0],
                    'last_name' => implode(' ', array_slice(explode(' ', $validated['name']), 1)),
                    'phone' => $validated['phone_number'],
                    'package_id' => $validated['package_id'],
                    'status' => Lead::STATUS_QUALIFIED,
                    'priority' => Lead::PRIORITY_HIGH,
                ]
            );

            // Link booking to lead
            $booking->lead_id = $lead->id;
            $booking->save();

            // Log interaction
            $lead->interactions()->create([
                'type' => 'booking_initiated',
                'subject' => 'Booking Started',
                'content' => "Started booking for {$package->name}",
                'channel' => 'website',
                'metadata' => [
                    'booking_id' => $booking->id,
                    'package_id' => $package->id,
                ],
            ]);
        }

        // Schedule abandoned booking reminder (NEW - Phase 2)
        SendAbandonedBookingReminder::dispatch($booking, 1)->delay(now()->addHours(2));

        // WhatsApp Redirection Logic
        $adminPhone = '628123456789'; // Replace with SiteSetting value later
        $message = "Halo Admin Travel Umroh,\n\nSaya *{$validated['name']}* berminat untuk booking paket:\n\n*{$package->name}*\nJumlah: {$validated['total_passengers']} orang\nTotal Estimasi: Rp " . number_format($totalPrice, 0, ',', '.') . "\n\nMohon info lebih lanjut. Terima kasih.";

        $whatsappUrl = "https://wa.me/{$adminPhone}?text=" . urlencode($message);

        return redirect()->away($whatsappUrl);
    }
}
