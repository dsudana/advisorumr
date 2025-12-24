<?php

namespace App\Filament\Resources\Bookings\Pages;

use App\Filament\Resources\Bookings\BookingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;

class ListBookings extends ListRecords
{
    protected static string $resource = BookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All'),
            'pending' => Tab::make('Pending')
                ->modifyQueryUsing(fn($query) => $query->where('status', 'pending')),
            'confirmed' => Tab::make('Confirmed')
                ->modifyQueryUsing(fn($query) => $query->where('status', 'confirmed')),
            'processing' => Tab::make('Processing')
                ->modifyQueryUsing(fn($query) => $query->where('status', 'processing')),
            'completed' => Tab::make('Completed')
                ->modifyQueryUsing(fn($query) => $query->where('status', 'completed')),
            'cancelled' => Tab::make('Cancelled')
                ->modifyQueryUsing(fn($query) => $query->where('status', 'cancelled')),
        ];
    }
}
