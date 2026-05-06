<?php

namespace App\Jobs;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNurtureCampaignEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Lead $lead;
    public string $campaignType;
    public int $emailIndex;

    /**
     * Create a new job instance.
     */
    public function __construct(Lead $lead, string $campaignType, int $emailIndex = 0)
    {
        $this->lead = $lead;
        $this->campaignType = $campaignType;
        $this->emailIndex = $emailIndex;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if (!$this->lead->email) {
            return;
        }

        $emailClass = $this->getEmailClass();

        if (!$emailClass) {
            return;
        }

        Mail::to($this->lead->email)->send(new $emailClass($this->lead, $this->campaignType, $this->emailIndex));

        // Log interaction
        $this->lead->interactions()->create([
            'type' => 'email_sent',
            'description' => "Nurture campaign '{$this->campaignType}' email {$this->emailIndex} sent",
            'metadata' => [
                'campaign_type' => $this->campaignType,
                'email_index' => $this->emailIndex,
            ],
        ]);
    }

    /**
     * Get the appropriate email class based on campaign type and index
     */
    private function getEmailClass(): ?string
    {
        $campaigns = [
            'umroh_basics' => [
                \App\Mail\NurtureUmrohBasics1::class,
                \App\Mail\NurtureUmrohBasics2::class,
                \App\Mail\NurtureUmrohBasics3::class,
            ],
            'package_comparison' => [
                \App\Mail\NurturePackageComparison1::class,
                \App\Mail\NurturePackageComparison2::class,
            ],
            'testimonials' => [
                \App\Mail\NurtureTestimonials1::class,
                \App\Mail\NurtureTestimonials2::class,
            ],
            'special_offers' => [
                \App\Mail\NurtureSpecialOffers1::class,
            ],
        ];

        if (!isset($campaigns[$this->campaignType][$this->emailIndex])) {
            return null;
        }

        return $campaigns[$this->campaignType][$this->emailIndex];
    }
}
