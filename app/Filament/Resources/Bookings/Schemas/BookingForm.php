<?php

namespace App\Filament\Resources\Bookings\Schemas;

use Filament\Schemas\Schema;

use Filament\Forms;

class BookingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Booking Details')
                            ->schema([
                                Forms\Components\TextInput::make('booking_code')
                                    ->disabled()
                                    ->dehydrated()
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(ignoreRecord: true),
                                Forms\Components\DatePicker::make('booking_date')
                                    ->required(),
                                Forms\Components\Select::make('user_id')
                                    ->relationship('user', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->label('Registered Customer (Optional)'),
                                Forms\Components\Select::make('package_id')
                                    ->relationship('package', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required(),
                                Forms\Components\Select::make('status')
                                    ->options([
                                        'pending' => 'Pending',
                                        'confirmed' => 'Confirmed',
                                        'processing' => 'Processing',
                                        'completed' => 'Completed',
                                        'cancelled' => 'Cancelled',
                                    ])
                                    ->required()
                                    ->default('pending'),
                                Forms\Components\Select::make('payment_status')
                                    ->options([
                                        'unpaid' => 'Unpaid',
                                        'partial' => 'Partial',
                                        'paid' => 'Paid',
                                        'refunded' => 'Refunded',
                                    ])
                                    ->required()
                                    ->default('unpaid'),
                            ])->columns(2),

                        Forms\Components\Section::make('Jamaah Details')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('email')
                                    ->email()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('phone_number')
                                    ->tel()
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('whatsapp_number')
                                    ->tel()
                                    ->maxLength(255),
                                Forms\Components\Textarea::make('address')
                                    ->rows(3)
                                    ->columnSpanFull(),
                            ])->columns(2),

                        Forms\Components\Section::make('Financials')
                            ->schema([
                                Forms\Components\TextInput::make('total_passengers')
                                    ->numeric()
                                    ->required()
                                    ->default(1),
                                Forms\Components\TextInput::make('base_price')
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->required(),
                                Forms\Components\TextInput::make('total_price')
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->required(),
                            ])->columns(3),
                    ])->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Notes')
                            ->schema([
                                Forms\Components\Textarea::make('notes')
                                    ->columnSpanFull(),
                            ]),
                    ])->columnSpan(['lg' => 1]),

                Forms\Components\Section::make('Passengers')
                    ->schema([
                        Forms\Components\Repeater::make('passengers')
                            ->relationship()
                            ->schema([
                                Forms\Components\TextInput::make('name')->required(),
                                Forms\Components\TextInput::make('passport_number'),
                                Forms\Components\Select::make('gender')
                                    ->options([
                                        'male' => 'Male',
                                        'female' => 'Female',
                                    ])->required(),
                                Forms\Components\DatePicker::make('birth_date'),
                            ])
                            ->columns(2)
                            ->defaultItems(1)
                            ->columnSpanFull(),
                    ]),
            ])->columns(3);
    }
}
