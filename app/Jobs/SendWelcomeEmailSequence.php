<?php

namespace App\Jobs;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmailSequence implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Lead $lead;
    public int $sequenceStep;

    /**
     * Create a new job instance.
     */
    public function __construct(Lead $lead, int $sequenceStep = 1)
    {
        $this->lead = $lead;
        $this->sequenceStep = $sequenceStep;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $emailClass = match($this->sequenceStep) {
            1 => \App\Mail\WelcomeSequenceStep1::class,
            2 => \App\Mail\WelcomeSequenceStep2::class,
            3 => \App\Mail\WelcomeSequenceStep3::class,
            default => null,
        };

        if (!$emailClass || !$this->lead->email) {
            return;
        }

        Mail::to($this->lead->email)->send(new $emailClass($this->lead));

        // Schedule next step if not the last
        if ($this->sequenceStep < 3) {
            $delayHours = match($this->sequenceStep) {
                1 => 24, // Send step 2 after 24 hours
                2 => 48, // Send step 3 after 48 hours from step 2
                default => 0,
            };

            $this->lead->interactions()->create([
                'type' => 'email_sent',
                'description' => "Welcome sequence step {$this->sequenceStep} sent",
                'metadata' => ['sequence_step' => $this->sequenceStep],
            ]);

            self::dispatch($this->lead, $this->sequenceStep + 1)
                ->delay(now()->addHours($delayHours));
        }
    }
}
