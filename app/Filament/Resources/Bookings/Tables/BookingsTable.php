<?php

namespace App\Filament\Resources\Bookings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

use Filament\Tables\Columns;
use Filament\Tables\Filters;
use App\Models\Booking;

class BookingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Columns\TextColumn::make('booking_code')
                    ->searchable()
                    ->sortable(),
                Columns\TextColumn::make('name')
                    ->label('Jamaah Name')
                    ->searchable()
                    ->sortable(),
                Columns\TextColumn::make('phone_number')
                    ->label('WhatsApp / Phone')
                    ->searchable(),
                Columns\TextColumn::make('package.name')
                    ->description(fn(Booking $record): string => strip_tags($record->notes ?? ''))
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'completed' => 'success',
                        'confirmed' => 'info',
                        'processing' => 'warning',
                        'cancelled' => 'danger',
                        default => 'gray', // pending
                    }),
                Columns\TextColumn::make('booking_date')
                    ->date()
                    ->sortable()
                    ->toggleable(),
                Columns\TextColumn::make('total_price')
                    ->money('IDR')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Columns\TextColumn::make('payment_status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'paid' => 'success',
                        'partial' => 'warning',
                        'refunded' => 'danger',
                        default => 'gray',
                    })
                    ->toggleable(isToggledHiddenByDefault: true),
                Columns\TextColumn::make('user.name')
                    ->label('Registered User')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'processing' => 'Processing',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ]),
                Filters\SelectFilter::make('payment_status')
                    ->options([
                        'unpaid' => 'Unpaid',
                        'partial' => 'Partial',
                        'paid' => 'Paid',
                        'refunded' => 'Refunded',
                    ]),
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
                \Filament\Actions\Action::make('open_whatsapp')
                    ->label('WhatsApp')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->color('success')
                    ->url(fn(\App\Models\Booking $record) => "https://wa.me/" . $record->whatsapp_number . "?text=" . urlencode("Halo {$record->name}, terkait booking paket {$record->package->name}..."))
                    ->openUrlInNewTab(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
