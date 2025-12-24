<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\Package;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;

class BookingSeeder extends Seeder
{
    public function run()
    {
        $customers = User::where('role', 'customer')->get();
        $packages = Package::all();

        if ($customers->isEmpty() || $packages->isEmpty()) {
            return;
        }

        // Create 20 dummy bookings
        for ($i = 0; $i < 20; $i++) {
            $customer = $customers->random();
            $package = $packages->random();
            $passengers = rand(1, 4);
            $totalPrice = $package->price * $passengers;

            $status = collect(['pending', 'confirmed', 'cancelled'])->random();
            $paymentStatus = match ($status) {
                'pending' => 'unpaid',
                'confirmed' => 'paid',
                'cancelled' => 'unpaid',
            };

            $booking = Booking::create([
                'booking_code' => 'BK-' . strtoupper(Str::random(10)),
                'user_id' => $customer->id,
                'package_id' => $package->id,
                'name' => $customer->name, // Populate name from customer
                'email' => $customer->email, // Populate email
                'phone_number' => fake()->phoneNumber(), // Fake phone
                'whatsapp_number' => fake()->e164PhoneNumber(), // Fake WA
                'address' => fake()->address(), // Fake address
                'booking_date' => Carbon::now()->subDays(rand(1, 30)),
                'total_passengers' => $passengers,
                'base_price' => $package->price,
                'total_price' => $totalPrice,
                'status' => $status,
                'payment_status' => $paymentStatus,
                'notes' => rand(0, 1) ? 'Request connecting room' : null,
            ]);

            // Create passengers for this booking
            for ($j = 0; $j < $passengers; $j++) {
                $booking->passengers()->create([
                    'name' => fake()->name(),
                    'passport_number' => strtoupper(Str::random(9)),
                    'gender' => rand(0, 1) ? 'male' : 'female',
                ]);
            }
        }
    }
}
