<?php

namespace App\Filament\Resources\Packages\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas;
use Filament\Forms;
use Illuminate\Support\Str;

class PackageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Schemas\Components\Group::make()
                    ->schema([
                        Schemas\Components\Section::make('Basic Information')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn(string $operation, $state, $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                                Forms\Components\TextInput::make('slug')
                                    ->disabled()
                                    ->dehydrated()
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(ignoreRecord: true),
                                Forms\Components\Select::make('category')
                                    ->options([
                                        'reguler' => 'Reguler',
                                        'plus' => 'Plus',
                                        'vip' => 'VIP',
                                    ])
                                    ->required(),
                                Forms\Components\FileUpload::make('image')
                                    ->image()
                                    ->directory('packages')
                                    ->columnSpanFull(),
                                Forms\Components\TextInput::make('airline')
                                    ->maxLength(255),
                                Forms\Components\Textarea::make('short_description')
                                    ->maxLength(65535)
                                    ->columnSpanFull(),
                                Forms\Components\RichEditor::make('description')
                                    ->columnSpanFull(),
                            ])->columns(2),

                        Schemas\Components\Section::make('Pricing & Dates')
                            ->schema([
                                Forms\Components\TextInput::make('price')
                                    ->numeric()
                                    ->required()
                                    ->prefix('Rp'),
                                Forms\Components\TextInput::make('discount_price')
                                    ->numeric()
                                    ->prefix('Rp'),
                                Forms\Components\DatePicker::make('departure_date')
                                    ->required(),
                                Forms\Components\DatePicker::make('return_date')
                                    ->required(),
                                Forms\Components\TextInput::make('duration_days')
                                    ->numeric()
                                    ->required(),
                                Forms\Components\TextInput::make('total_seats')
                                    ->numeric()
                                    ->required(),
                                Forms\Components\TextInput::make('available_seats')
                                    ->numeric()
                                    ->required(),
                            ])->columns(2),

                        Schemas\Components\Section::make('Hotel Details')
                            ->schema([
                                Forms\Components\TextInput::make('makkah_hotel_name')->label('Makkah Hotel'),
                                Forms\Components\TextInput::make('makkah_hotel_stars')->numeric()->label('Stars'),
                                Forms\Components\TextInput::make('madinah_hotel_name')->label('Madinah Hotel'),
                                Forms\Components\TextInput::make('madinah_hotel_stars')->numeric()->label('Stars'),
                            ])->columns(2),
                    ])->columnSpan(['lg' => 2]),

                Schemas\Components\Group::make()
                    ->schema([
                        Schemas\Components\Section::make('Status')
                            ->schema([
                                Forms\Components\Select::make('status')
                                    ->options([
                                        'draft' => 'Draft',
                                        'published' => 'Published',
                                        'archived' => 'Archived',
                                    ])
                                    ->required()
                                    ->default('draft'),
                                Forms\Components\Toggle::make('is_featured'),
                            ]),

                        Schemas\Components\Section::make('SEO')
                            ->schema([
                                Forms\Components\TextInput::make('meta_title'),
                                Forms\Components\Textarea::make('meta_description'),
                                Forms\Components\TextInput::make('meta_keywords'),
                            ])->collapsed(),
                    ])->columnSpan(['lg' => 1]),

                Schemas\Components\Section::make('Itinerary')
                    ->schema([
                        Forms\Components\Repeater::make('itineraries')
                            ->relationship()
                            ->schema([
                                Forms\Components\TextInput::make('day')->numeric()->required(),
                                Forms\Components\TextInput::make('title')->required(),
                                Forms\Components\Textarea::make('description'),
                            ])
                            ->columns(2)
                            ->defaultItems(1)
                            ->columnSpanFull(),
                    ]),

                Schemas\Components\Section::make('Facilities')
                    ->schema([
                        Forms\Components\Repeater::make('facilities')
                            ->relationship()
                            ->schema([
                                Forms\Components\TextInput::make('facility')->required(),
                                Forms\Components\TextInput::make('icon'),
                            ])
                            ->columns(2)
                            ->defaultItems(1)
                            ->columnSpanFull(),
                    ]),
            ])->columns(3);
    }
}
