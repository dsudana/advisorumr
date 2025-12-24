<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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

        \App\Models\SiteVisit::firstOrCreate([
            'ip_address' => $ip,
            'visit_date' => $date,
        ]);

        return $next($request);
    }
}
