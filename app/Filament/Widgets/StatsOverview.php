<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\User;

class StatsOverview extends BaseWidget
{
    protected ?string $heading = 'Stats Overview';

    protected function getStats(): array
    {
        return [
            Stat::make('Total Revenue', 'Rp ' . number_format(Payment::where('payment_status', 'success')->sum('amount'), 0, ',', '.'))
                ->description('Total verified income')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Total Bookings', Booking::count())
                ->description('All time bookings')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('primary'),
            Stat::make('Pending Bookings', Booking::where('status', 'pending')->count())
                ->description('Needs attention')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),
        ];
    }
}
