<?php

namespace App\Jobs;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendAbandonedBookingReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Booking $booking;
    public int $reminderStep;

    /**
     * Create a new job instance.
     */
    public function __construct(Booking $booking, int $reminderStep = 1)
    {
        $this->booking = $booking;
        $this->reminderStep = $reminderStep;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Only send if booking is still pending payment
        if ($this->booking->payment_status !== 'pending') {
            return;
        }

        $emailClass = match($this->reminderStep) {
            1 => \App\Mail\AbandonedBookingReminder1::class,
            2 => \App\Mail\AbandonedBookingReminder2::class,
            3 => \App\Mail\AbandonedBookingFinalNotice::class,
            default => null,
        };

        if (!$emailClass || !$this->booking->email) {
            return;
        }

        Mail::to($this->booking->email)->send(new $emailClass($this->booking));

        // Log interaction
        $this->booking->lead()->first()?->interactions()->create([
            'type' => 'email_sent',
            'description' => "Abandoned booking reminder {$this->reminderStep} sent",
            'metadata' => [
                'reminder_step' => $this->reminderStep,
                'booking_id' => $this->booking->id,
            ],
        ]);

        // Schedule next reminder
        if ($this->reminderStep < 3) {
            $delayHours = match($this->reminderStep) {
                1 => 4,   // Send reminder 2 after 4 hours
                2 => 24,  // Send final notice after 24 hours
                default => 0,
            };

            self::dispatch($this->booking, $this->reminderStep + 1)
                ->delay(now()->addHours($delayHours));
        }
    }
}
