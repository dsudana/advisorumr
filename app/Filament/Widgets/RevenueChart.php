<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RevenueChart extends ChartWidget
{
    protected ?string $heading = 'Monthly Revenue';

    protected function getData(): array
    {
        $data = Payment::select(
            DB::raw('SUM(amount) as total'),
            DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month")
        )
            ->where('payment_status', 'success')
            ->where('created_at', '>=', now()->subYear())
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Revenue',
                    'data' => $data->pluck('total')->toArray(),
                    'borderColor' => '#9333ea',
                    'fill' => 'start',
                ],
            ],
            'labels' => $data->pluck('month')->map(fn($date) => Carbon::parse($date)->format('M Y'))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
