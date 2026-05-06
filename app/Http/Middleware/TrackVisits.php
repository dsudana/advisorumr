<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\ConversionEvent;
use App\Models\SiteVisit;

class TrackVisits
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip();
        $date = now()->toDateString();

        // Track site visit (legacy)
        SiteVisit::firstOrCreate([
            'ip_address' => $ip,
            'visit_date' => $date,
        ]);

        // Store UTM parameters in session for later use
        if ($request->filled(['utm_source', 'utm_medium', 'utm_campaign'])) {
            session([
                'utm_source' => $request->input('utm_source'),
                'utm_medium' => $request->input('utm_medium'),
                'utm_campaign' => $request->input('utm_campaign'),
                'utm_term' => $request->input('utm_term'),
                'utm_content' => $request->input('utm_content'),
            ]);
        }

        // Track page view event asynchronously (queue in production)
        if ($this->shouldTrackPageView($request)) {
            ConversionEvent::track(
                ConversionEvent::EVENT_PAGE_VIEW,
                'page_view',
                [
                    'page_url' => $request->fullUrl(),
                    'page_title' => $this->extractPageTitle($request),
                    'session_id' => session()->getId(),
                    ...$this->detectDeviceInfo($request),
                ]
            );
        }

        return $next($request);
    }

    /**
     * Determine if we should track this page view
     */
    private function shouldTrackPageView(Request $request): bool
    {
        // Don't track admin routes, API calls, or static assets
        if ($request->is('admin*', 'api/*', 'filament/*', 'storage/*')) {
            return false;
        }

        // Don't track AJAX requests
        if ($request->ajax() || $request->wantsJson()) {
            return false;
        }

        return true;
    }

    /**
     * Extract page title from URL or content
     */
    private function extractPageTitle(Request $request): ?string
    {
        $path = $request->path();
        
        $titles = [
            '/' => 'Home - Travel Umroh',
            'packages' => 'Packages - Travel Umroh',
            'about' => 'About Us - Travel Umroh',
            'contact' => 'Contact - Travel Umroh',
            'artikel' => 'Articles - Travel Umroh',
            'gallery' => 'Gallery - Travel Umroh',
        ];

        foreach ($titles as $route => $title) {
            if (str_starts_with($path, $route)) {
                return $title;
            }
        }

        return null;
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
