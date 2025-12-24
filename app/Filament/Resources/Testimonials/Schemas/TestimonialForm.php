<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components; // Added this use statement for form components

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Components\TextInput::make('position')
                    ->label('Keterangan')
                    ->placeholder('Contoh: Jamaah Umroh April 2025')
                    ->maxLength(255),
                Components\Textarea::make('content')
                    ->required()
                    ->columnSpanFull(),
                Components\Select::make('rating')
                    ->options([
                        1 => '1 Star',
                        2 => '2 Stars',
                        3 => '3 Stars',
                        4 => '4 Stars',
                        5 => '5 Stars',
                    ])
                    ->default(5)
                    ->required(),
                Components\FileUpload::make('photo')
                    ->image()
                    ->disk('public')
                    ->directory('testimonials'),
                Components\TextInput::make('order')
                    ->numeric()
                    ->default(0),
                Components\Toggle::make('is_active')
                    ->required()
                    ->default(true),
            ]);
    }
}
