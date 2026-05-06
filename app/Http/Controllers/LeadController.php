<?php

namespace App\Http\Controllers;

use App\Jobs\SendWelcomeEmailSequence;
use App\Models\Lead;
use App\Models\LeadSource;
use App\Models\ConversionEvent;
use App\Models\NewsletterSubscriber;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class LeadController extends Controller
{
    /**
     * Capture a new lead from any form on the website
     */
    public function capture(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'whatsapp_number' => 'nullable|string|max:20',
            'package_id' => 'nullable|exists:packages,id',
            'preferred_travel_date' => 'nullable|date',
            'number_of_passengers' => 'nullable|integer|min:1',
            'estimated_budget' => 'nullable|numeric',
            'message' => 'nullable|string',
            'source' => 'nullable|string|max:100',
        ]);

        // Detect UTM parameters
        $utmData = $this->extractUtmParameters($request);
        
        // Detect device and browser info
        $deviceData = $this->detectDeviceInfo($request);

        // Find or create lead source
        $leadSource = null;
        if ($request->filled('source')) {
            $leadSource = LeadSource::firstOrCreate(
                ['name' => strtolower(Str::slug($request->source))],
                ['description' => $request->source]
            );
        }

        // Check if lead already exists
        $existingLead = Lead::where('email', $validated['email'])
            ->orWhere('phone', $validated['phone'])
            ->first();

        if ($existingLead) {
            // Update existing lead
            $existingLead->update(array_merge($validated, [
                'lead_source_id' => $leadSource?->id,
                ...$utmData,
                ...$deviceData,
                'landing_page' => $request->headers->get('referer'),
            ]));

            $lead = $existingLead;
            
            // Log interaction
            LeadInteraction::create([
                'lead_id' => $lead->id,
                'type' => 'form_submission',
                'subject' => 'Form Re-submission',
                'content' => $validated['message'] ?? null,
                'channel' => 'website',
                'metadata' => ['page' => $request->url()],
            ]);
        } else {
            // Create new lead
            $lead = Lead::create(array_merge($validated, [
                'lead_source_id' => $leadSource?->id,
                ...$utmData,
                ...$deviceData,
                'landing_page' => $request->headers->get('referer'),
                'status' => Lead::STATUS_NEW,
                'priority' => Lead::PRIORITY_MEDIUM,
            ]));

            // Log initial interaction
            LeadInteraction::create([
                'lead_id' => $lead->id,
                'type' => 'form_submission',
                'subject' => 'New Lead Capture',
                'content' => $validated['message'] ?? null,
                'channel' => 'website',
                'metadata' => ['page' => $request->url()],
            ]);

            // Send welcome email sequence (NEW - Phase 2)
            SendWelcomeEmailSequence::dispatch($lead, 1);
        }

        // Track conversion event
        ConversionEvent::track(
            ConversionEvent::EVENT_LEAD_CAPTURE,
            'lead_form_submit',
            [
                'lead_id' => $lead->id,
                'page_url' => $request->url(),
                'session_id' => session()->getId(),
                ...$utmData,
                ...$deviceData,
            ]
        );

        // Queue notification email to admin
        // \App\Mail\NewLeadNotification::dispatch($lead);

        // Queue welcome/follow-up email to lead
        // \App\Mail\LeadWelcomeEmail::dispatch($lead);

        return response()->json([
            'success' => true,
            'message' => 'Thank you! We will contact you soon.',
            'lead_id' => $lead->id,
        ]);
    }

    /**
     * Newsletter subscription
     */
    public function subscribeNewsletter(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'interests' => 'nullable|array',
            'source' => 'nullable|string|max:100',
        ]);

        $utmData = $this->extractUtmParameters($request);

        $subscriber = NewsletterSubscriber::firstOrCreate(
            ['email' => $validated['email']],
            [
                'first_name' => $validated['first_name'] ?? null,
                'last_name' => $validated['last_name'] ?? null,
                'interests' => $validated['interests'] ?? null,
                'source' => $validated['source'] ?? 'website',
                ...$utmData,
                'is_confirmed' => true, // Double opt-in can be enabled later
                'confirmed_at' => now(),
            ]
        );

        // If was unsubscribed, re-subscribe
        if ($subscriber->unsubscribed_at) {
            $subscriber->update([
                'unsubscribed_at' => null,
                'is_confirmed' => true,
                'confirmed_at' => now(),
            ]);
        }

        // Track event
        ConversionEvent::track(
            ConversionEvent::EVENT_NEWSLETTER_SIGNUP,
            'newsletter_subscribe',
            [
                'page_url' => $request->url(),
                'session_id' => session()->getId(),
                ...$utmData,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Successfully subscribed to our newsletter!',
        ]);
    }

    /**
     * Track WhatsApp click
     */
    public function trackWhatsappClick(Request $request)
    {
        $utmData = $this->extractUtmParameters($request);
        $deviceData = $this->detectDeviceInfo($request);

        ConversionEvent::track(
            ConversionEvent::EVENT_WHATSAPP_CLICK,
            'whatsapp_button_click',
            [
                'page_url' => $request->url(),
                'session_id' => session()->getId(),
                'phone_number' => $request->input('phone'),
                ...$utmData,
                ...$deviceData,
            ]
        );

        return response()->json(['success' => true]);
    }

    /**
     * Track phone click
     */
    public function trackPhoneClick(Request $request)
    {
        $utmData = $this->extractUtmParameters($request);
        $deviceData = $this->detectDeviceInfo($request);

        ConversionEvent::track(
            ConversionEvent::EVENT_PHONE_CLICK,
            'phone_button_click',
            [
                'page_url' => $request->url(),
                'session_id' => session()->getId(),
                'phone_number' => $request->input('phone'),
                ...$utmData,
                ...$deviceData,
            ]
        );

        return response()->json(['success' => true]);
    }

    /**
     * Download lead magnet (ebook, guide, etc.)
     */
    public function downloadLeadMagnet(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
            'first_name' => 'required|string|max:255',
            'resource' => 'required|string|max:255', // ebook, guide, checklist, etc.
        ]);

        $utmData = $this->extractUtmParameters($request);

        // Create or update lead
        $lead = Lead::firstOrCreate(
            ['email' => $validated['email']],
            [
                'first_name' => $validated['first_name'],
                'status' => Lead::STATUS_NEW,
                ...$utmData,
            ]
        );

        // Track download event
        ConversionEvent::track(
            ConversionEvent::EVENT_DOWNLOAD,
            'lead_magnet_download',
            [
                'lead_id' => $lead->id,
                'resource' => $validated['resource'],
                'page_url' => $request->url(),
                'session_id' => session()->getId(),
                ...$utmData,
            ]
        );

        // Log interaction
        LeadInteraction::create([
            'lead_id' => $lead->id,
            'type' => 'form_submission',
            'subject' => "Downloaded: {$validated['resource']}",
            'content' => "Lead downloaded {$validated['resource']}",
            'channel' => 'website',
            'metadata' => ['resource' => $validated['resource']],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Your download will start shortly.',
        ]);
    }

    /**
     * Extract UTM parameters from request
     */
    private function extractUtmParameters(Request $request): array
    {
        return [
            'utm_source' => $request->input('utm_source') ?? session('utm_source'),
            'utm_medium' => $request->input('utm_medium') ?? session('utm_medium'),
            'utm_campaign' => $request->input('utm_campaign') ?? session('utm_campaign'),
            'utm_term' => $request->input('utm_term') ?? session('utm_term'),
            'utm_content' => $request->input('utm_content') ?? session('utm_content'),
        ];
    }

    /**
     * Detect device and browser information
     */
    private function detectDeviceInfo(Request $request): array
    {
        $userAgent = $request->userAgent() ?? '';
        
        // Simple device detection (can use more sophisticated libraries)
        $deviceType = 'desktop';
        if (preg_match('/Mobile|Android|iP(hone|od)|IEMobile|BlackBerry|Kindle|Silk-Accelerated/i', $userAgent)) {
            $deviceType = 'mobile';
        } elseif (preg_match('/Tablet|iPad|PlayBook|Silk-Accelerated/i', $userAgent)) {
            $deviceType = 'tablet';
        }

        // Simple browser detection
        $browser = 'Unknown';
        if (preg_match('/Chrome/i', $userAgent)) {
            $browser = 'Chrome';
        } elseif (preg_match('/Safari/i', $userAgent)) {
            $browser = 'Safari';
        } elseif (preg_match('/Firefox/i', $userAgent)) {
            $browser = 'Firefox';
        } elseif (preg_match('/MSIE|Trident/i', $userAgent)) {
            $browser = 'Internet Explorer';
        } elseif (preg_match('/Edge/i', $userAgent)) {
            $browser = 'Edge';
        }

        // OS detection
        $os = 'Unknown';
        if (preg_match('/Windows/i', $userAgent)) {
            $os = 'Windows';
        } elseif (preg_match('/Mac OS X/i', $userAgent)) {
            $os = 'macOS';
        } elseif (preg_match('/Linux/i', $userAgent)) {
            $os = 'Linux';
        } elseif (preg_match('/Android/i', $userAgent)) {
            $os = 'Android';
        } elseif (preg_match('/iOS/i', $userAgent)) {
            $os = 'iOS';
        }

        return [
            'device_type' => $deviceType,
            'browser' => $browser,
            'os' => $os,
            'ip_address' => $request->ip(),
        ];
    }
}
