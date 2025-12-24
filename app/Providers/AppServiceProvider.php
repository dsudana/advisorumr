<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Observers
        \App\Models\Booking::observe(\App\Observers\BookingObserver::class);
        \App\Models\Payment::observe(\App\Observers\PaymentObserver::class);

        // Listeners
        \Illuminate\Support\Facades\Event::listen(
            \Illuminate\Auth\Events\Registered::class,
            \App\Listeners\SendWelcomeEmail::class,
        );

        // Share Site Settings
        try {
            $settings = \App\Models\SiteSetting::firstOrCreate([
                'id' => 1
            ], [
                'site_name' => config('app.name'),
            ]);

            \Illuminate\Support\Facades\View::share('site_settings', $settings);

            // Dynamic Config
            config(['app.name' => $settings->site_name]);
        } catch (\Exception $e) {
            // Fallback if table doesn't exist yet (during migration)
            \Illuminate\Support\Facades\View::share('site_settings', new \App\Models\SiteSetting(['site_name' => config('app.name')]));
        }
    }
}
