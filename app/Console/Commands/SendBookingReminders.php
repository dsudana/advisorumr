<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class SendBookingReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-booking-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Sending booking reminders...');

        // H-7, H-3, H-1 Reminders
        $days = [7, 3, 1];
        foreach ($days as $day) {
            $date = Carbon::now()->addDays($day)->toDateString();

            $bookings = Booking::whereHas('package', function ($query) use ($date) {
                $query->whereDate('departure_date', $date);
            })->where('status', 'confirmed')->get();

            foreach ($bookings as $booking) {
                Mail::to($booking->user)->send(new \App\Mail\DepartureReminderEmail($booking));
                $this->info("Sent H-{$day} reminder to {$booking->user->email}");
            }
        }

        // Feedback Request (H+3 after return)
        $returnDate = Carbon::now()->subDays(3)->toDateString();
        $returnedBookings = Booking::whereHas('package', function ($query) use ($returnDate) {
            $query->whereDate('return_date', $returnDate);
        })->where('status', 'completed')->get();

        foreach ($returnedBookings as $booking) {
            Mail::to($booking->user)->send(new \App\Mail\FeedbackRequestEmail($booking));
            $this->info("Sent feedback request to {$booking->user->email}");
        }

        $this->info('All reminders sent successfully.');
    }
}
