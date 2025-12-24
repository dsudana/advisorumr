<?php

namespace App\Filament\Resources\Packages\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

use Filament\Tables\Columns;
use Filament\Tables\Filters;

class PackagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                Columns\TextColumn::make('category')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'vip' => 'warning',
                        'plus' => 'info',
                        'reguler' => 'gray',
                    }),
                Columns\TextColumn::make('price')
                    ->money('IDR')
                    ->sortable(),
                Columns\TextColumn::make('departure_date')
                    ->date()
                    ->sortable(),
                Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'published' => 'success',
                        'draft' => 'gray',
                        'archived' => 'danger',
                    }),
                Columns\IconColumn::make('is_featured')
                    ->boolean(),
            ])
            ->filters([
                Filters\SelectFilter::make('category')
                    ->options([
                        'reguler' => 'Reguler',
                        'plus' => 'Plus',
                        'vip' => 'VIP',
                    ]),
                Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'archived' => 'Archived',
                    ]),
                Filters\TernaryFilter::make('is_featured'),
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
