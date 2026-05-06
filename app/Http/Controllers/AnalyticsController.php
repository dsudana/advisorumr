<?php

namespace App\Http\Controllers;

use App\Models\ConversionEvent;
use App\Models\Lead;
use App\Models\Booking;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    /**
     * Track any conversion event
     */
    public function trackEvent(Request $request)
    {
        $validated = $request->validate([
            'event_type' => 'required|string|max:100',
            'event_name' => 'required|string|max:255',
            'event_category' => 'nullable|string|max:100',
            'page_url' => 'nullable|url|max:2048',
            'page_title' => 'nullable|string|max:500',
            'value' => 'nullable|numeric',
            'currency' => 'nullable|string|max:3',
            'properties' => 'nullable|array',
            'lead_id' => 'nullable|exists:leads,id',
            'booking_id' => 'nullable|exists:bookings,id',
        ]);

        // Extract UTM parameters
        $utmData = [
            'utm_source' => $request->input('utm_source') ?? session('utm_source'),
            'utm_medium' => $request->input('utm_medium') ?? session('utm_medium'),
            'utm_campaign' => $request->input('utm_campaign') ?? session('utm_campaign'),
            'utm_term' => $request->input('utm_term') ?? session('utm_term'),
            'utm_content' => $request->input('utm_content') ?? session('utm_content'),
        ];

        // Detect device info
        $deviceData = $this->detectDeviceInfo($request);

        $event = ConversionEvent::create([
            'lead_id' => $validated['lead_id'] ?? null,
            'user_id' => auth()->id(),
            'booking_id' => $validated['booking_id'] ?? null,
            'event_type' => $validated['event_type'],
            'event_name' => $validated['event_name'],
            'event_category' => $validated['event_category'] ?? 'general',
            'page_url' => $validated['page_url'] ?? $request->headers->get('referer'),
            'page_title' => $validated['page_title'] ?? null,
            'referrer_url' => $request->headers->get('referer'),
            ...$utmData,
            ...$deviceData,
            'value' => $validated['value'] ?? null,
            'currency' => $validated['currency'] ?? 'IDR',
            'properties' => $validated['properties'] ?? null,
            'session_id' => $request->input('session_id') ?? session()->getId(),
        ]);

        return response()->json([
            'success' => true,
            'event_id' => $event->id,
        ]);
    }

    /**
     * Get funnel analytics data
     */
    public function funnel(Request $request)
    {
        $startDate = $request->input('start_date', now()->subDays(30));
        $endDate = $request->input('end_date', now());

        $funnel = [
            'page_views' => ConversionEvent::whereBetween('created_at', [$startDate, $endDate])
                ->where('event_type', ConversionEvent::EVENT_PAGE_VIEW)
                ->count(),
            
            'lead_captures' => ConversionEvent::whereBetween('created_at', [$startDate, $endDate])
                ->where('event_type', ConversionEvent::EVENT_LEAD_CAPTURE)
                ->count(),
            
            'newsletter_signups' => ConversionEvent::whereBetween('created_at', [$startDate, $endDate])
                ->where('event_type', ConversionEvent::EVENT_NEWSLETTER_SIGNUP)
                ->count(),
            
            'whatsapp_clicks' => ConversionEvent::whereBetween('created_at', [$startDate, $endDate])
                ->where('event_type', ConversionEvent::EVENT_WHATSAPP_CLICK)
                ->count(),
            
            'checkout_starts' => ConversionEvent::whereBetween('created_at', [$startDate, $endDate])
                ->where('event_type', ConversionEvent::EVENT_CHECKOUT_START)
                ->count(),
            
            'bookings_completed' => Booking::whereBetween('created_at', [$startDate, $endDate])
                ->count(),
            
            'payments_completed' => ConversionEvent::whereBetween('created_at', [$startDate, $endDate])
                ->where('event_type', ConversionEvent::EVENT_PAYMENT_COMPLETE)
                ->count(),
        ];

        // Calculate conversion rates
        $funnel['conversion_rates'] = [
            'visitor_to_lead' => $funnel['page_views'] > 0 
                ? round(($funnel['lead_captures'] / $funnel['page_views']) * 100, 2) 
                : 0,
            'lead_to_booking' => $funnel['lead_captures'] > 0 
                ? round(($funnel['bookings_completed'] / $funnel['lead_captures']) * 100, 2) 
                : 0,
            'visitor_to_booking' => $funnel['page_views'] > 0 
                ? round(($funnel['bookings_completed'] / $funnel['page_views']) * 100, 4) 
                : 0,
            'checkout_to_booking' => $funnel['checkout_starts'] > 0 
                ? round(($funnel['bookings_completed'] / $funnel['checkout_starts']) * 100, 2) 
                : 0,
        ];

        return response()->json([
            'success' => true,
            'period' => [
                'start' => $startDate,
                'end' => $endDate,
            ],
            'funnel' => $funnel,
        ]);
    }

    /**
     * Get lead source performance
     */
    public function leadSources(Request $request)
    {
        $startDate = $request->input('start_date', now()->subDays(30));
        $endDate = $request->input('end_date', now());

        $sources = DB::table('leads')
            ->leftJoin('lead_sources', 'leads.lead_source_id', '=', 'lead_sources.id')
            ->select(
                'lead_sources.name as source',
                DB::raw('COUNT(*) as total_leads'),
                DB::raw('SUM(CASE WHEN leads.status = "converted" THEN 1 ELSE 0 END) as converted'),
                DB::raw('AVG(leads.estimated_budget) as avg_budget')
            )
            ->whereBetween('leads.created_at', [$startDate, $endDate])
            ->groupBy('lead_sources.id', 'lead_sources.name')
            ->orderByDesc('total_leads')
            ->get();

        return response()->json([
            'success' => true,
            'sources' => $sources,
        ]);
    }

    /**
     * Get recent activity for dashboard
     */
    public function recentActivity()
    {
        $recentLeads = Lead::with('source')
            ->latest()
            ->take(10)
            ->get();

        $recentSubscribers = NewsletterSubscriber::latest()
            ->take(5)
            ->get();

        $todayStats = [
            'new_leads' => Lead::whereDate('created_at', today())->count(),
            'converted_today' => Lead::whereDate('converted_at', today())->count(),
            'new_subscribers' => NewsletterSubscriber::whereDate('created_at', today())->count(),
            'total_bookings' => Booking::whereDate('created_at', today())->count(),
        ];

        return response()->json([
            'success' => true,
            'recent_leads' => $recentLeads,
            'recent_subscribers' => $recentSubscribers,
            'today_stats' => $todayStats,
        ]);
    }

    /**
     * Get conversion trends over time
     */
    public function trends(Request $request)
    {
        $days = $request->input('days', 30);
        $groupBy = $request->input('group_by', 'day'); // day, week, month

        $format = match($groupBy) {
            'week' => '%Y-%u',
            'month' => '%Y-%m',
            default => '%Y-%m-%d',
        };

        $trends = DB::table('conversion_events')
            ->select(
                DB::raw("DATE_FORMAT(created_at, '$format') as period"),
                DB::raw('COUNT(*) as total_events'),
                DB::raw('SUM(CASE WHEN event_type = "lead_capture" THEN 1 ELSE 0 END) as leads'),
                DB::raw('SUM(CASE WHEN event_type = "payment_complete" THEN 1 ELSE 0 END) as payments'),
                DB::raw('SUM(value) as total_value')
            )
            ->where('created_at', '>=', now()->subDays($days))
            ->groupBy('period')
            ->orderBy('period')
            ->get();

        return response()->json([
            'success' => true,
            'trends' => $trends,
        ]);
    }

    /**
     * Detect device and browser information
     */
    private function detectDeviceInfo(Request $request): array
    {
        $userAgent = $request->userAgent() ?? '';
        
        $deviceType = 'desktop';
        if (preg_match('/Mobile|Android|iP(hone|od)|IEMobile|BlackBerry|Kindle|Silk-Accelerated/i', $userAgent)) {
            $deviceType = 'mobile';
        } elseif (preg_match('/Tablet|iPad|PlayBook|Silk-Accelerated/i', $userAgent)) {
            $deviceType = 'tablet';
        }

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
