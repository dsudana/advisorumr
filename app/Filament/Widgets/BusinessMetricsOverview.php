<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\SiteVisit;
use App\Models\User;

class BusinessMetricsOverview extends BaseWidget
{
    protected ?string $heading = 'Business Metrics';

    protected function getStats(): array
    {
        $totalVisits = SiteVisit::count();
        $totalBookings = Booking::count();
        $conversionRate = $totalVisits > 0 ? ($totalBookings / $totalVisits) * 100 : 0;

        $aov = Payment::where('payment_status', 'success')->avg('amount') ?? 0;

        $totalCustomers = User::has('bookings')->count();
        $repeatCustomers = User::has('bookings', '>', 1)->count();
        $retentionRate = $totalCustomers > 0 ? ($repeatCustomers / $totalCustomers) * 100 : 0;

        return [
            Stat::make('Conversion Rate', number_format($conversionRate, 2) . '%')
                ->description('Visitors to Bookings')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color($conversionRate > 1 ? 'success' : 'danger'),

            Stat::make('Average Order Value', 'Rp ' . number_format($aov, 0, ',', '.'))
                ->description('Average success payment')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success'),

            Stat::make('Customer Retention', number_format($retentionRate, 2) . '%')
                ->description('Repeat customers')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),
        ];
    }
}
