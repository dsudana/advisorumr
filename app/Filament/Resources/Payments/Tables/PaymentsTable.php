<?php

namespace App\Filament\Resources\Payments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

use Filament\Tables\Columns;
use Filament\Tables\Filters;

class PaymentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Columns\TextColumn::make('booking.booking_code')
                    ->searchable()
                    ->sortable(),
                Columns\TextColumn::make('amount')
                    ->money('IDR')
                    ->sortable(),
                Columns\TextColumn::make('payment_gateway')
                    ->label('Method')
                    ->searchable(),
                Columns\TextColumn::make('transaction_id')
                    ->searchable(),
                Columns\TextColumn::make('payment_status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'success' => 'success',
                        'pending' => 'warning',
                        'failed', 'expire', 'cancel' => 'danger',
                        default => 'gray',
                    }),
                Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filters\SelectFilter::make('payment_status')
                    ->options([
                        'pending' => 'Pending',
                        'success' => 'Success',
                        'failed' => 'Failed',
                        'expire' => 'Expired',
                        'cancel' => 'Cancelled',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
