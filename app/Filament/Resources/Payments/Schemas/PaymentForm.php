<?php

namespace App\Filament\Resources\Payments\Schemas;

use Filament\Schemas\Schema;

use Filament\Forms;

class PaymentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\Select::make('booking_id')
                    ->relationship('booking', 'booking_code')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('amount')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),
                Forms\Components\TextInput::make('payment_gateway')
                    ->label('Method')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('transaction_id')
                    ->maxLength(255),
                Forms\Components\Select::make('payment_status')
                    ->options([
                        'pending' => 'Pending',
                        'success' => 'Success',
                        'failed' => 'Failed',
                        'expire' => 'Expired',
                        'cancel' => 'Cancelled',
                    ])
                    ->required()
                    ->default('pending'),
                Forms\Components\TextInput::make('snap_token')
                    ->disabled()
                    ->maxLength(255),
                Forms\Components\Textarea::make('gateway_response')
                    ->columnSpanFull()
                    ->disabled(),
            ]);
    }
}
