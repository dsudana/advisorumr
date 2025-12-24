<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'package_id' => 'required|exists:packages,id',
            'total_passengers' => 'required|integer|min:1',
        ]);

        $package = Package::findOrFail($validated['package_id']);

        $basePrice = $package->price;
        $totalPrice = $basePrice * $validated['total_passengers'];

        $booking = Booking::create([
            'name' => $validated['name'],
            'phone_number' => $validated['phone_number'],
            'whatsapp_number' => $validated['phone_number'], // Assume same number initially
            'package_id' => $validated['package_id'],
            'booking_date' => now(),
            'total_passengers' => $validated['total_passengers'],
            'base_price' => $basePrice,
            'total_price' => $totalPrice,
            'status' => 'pending',
            'payment_status' => 'unpaid',
            'booking_code' => 'B-' . strtoupper(Str::random(8)),
            'notes' => 'Booking via Website',
        ]);

        // WhatsApp Redirection Logic
        $adminPhone = '628123456789'; // Replace with SiteSetting value later
        $message = "Halo Admin Travel Umroh,\n\nSaya *{$validated['name']}* berminat untuk booking paket:\n\n*{$package->name}*\nJumlah: {$validated['total_passengers']} orang\nTotal Estimasi: Rp " . number_format($totalPrice, 0, ',', '.') . "\n\nMohon info lebih lanjut. Terima kasih.";

        $whatsappUrl = "https://wa.me/{$adminPhone}?text=" . urlencode($message);

        return redirect()->away($whatsappUrl);
    }
}
