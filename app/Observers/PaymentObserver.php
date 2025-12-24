<?php

namespace App\Observers;

use App\Models\Payment;
use Illuminate\Support\Facades\Mail;

class PaymentObserver
{
    /**
     * Handle the Payment "created" event.
     */
    public function created(Payment $payment): void
    {
        //
    }

    /**
     * Handle the Payment "updated" event.
     */
    public function updated(Payment $payment): void
    {
        if ($payment->wasChanged('payment_status') && $payment->payment_status === 'success') {
            $payment->booking->update(['payment_status' => 'paid', 'status' => 'confirmed']);

            Mail::to($payment->booking->user)->send(new \App\Mail\PaymentSuccessEmail($payment->booking));
        }
    }

    /**
     * Handle the Payment "deleted" event.
     */
    public function deleted(Payment $payment): void
    {
        //
    }

    /**
     * Handle the Payment "restored" event.
     */
    public function restored(Payment $payment): void
    {
        //
    }

    /**
     * Handle the Payment "force deleted" event.
     */
    public function forceDeleted(Payment $payment): void
    {
        //
    }
}
