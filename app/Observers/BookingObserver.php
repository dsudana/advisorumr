<?php

namespace App\Observers;

use App\Models\Booking;
use Illuminate\Support\Facades\Mail;

class BookingObserver
{
    /**
     * Handle the Booking "created" event.
     */
    public function created(Booking $booking): void
    {
        $recipient = $booking->user ?? $booking->email;

        if ($recipient) {
            Mail::to($recipient)->send(new \App\Mail\BookingCreatedEmail($booking));
        }
    }

    /**
     * Handle the Booking "updated" event.
     */
    public function updated(Booking $booking): void
    {
        if ($booking->wasChanged('status')) {
            $recipient = $booking->user ?? $booking->email;

            if ($recipient) {
                Mail::to($recipient)->send(new \App\Mail\BookingStatusUpdatedEmail($booking));
            }
        }
    }
}
