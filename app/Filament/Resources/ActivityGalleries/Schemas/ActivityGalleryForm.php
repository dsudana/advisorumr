<?php

namespace App\Filament\Resources\ActivityGalleries\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components;

class ActivityGalleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Components\DatePicker::make('activity_date')
                    ->required()
                    ->label('Date of Activity'),
                Components\FileUpload::make('image')
                    ->image()
                    ->disk('public')
                    ->directory('activity-galleries')
                    ->required(),
                Components\Textarea::make('description')
                    ->columnSpanFull(),
                Components\TextInput::make('video_url')
                    ->label('Video URL (YouTube Embed)')
                    ->url()
                    ->placeholder('https://www.youtube.com/embed/...'),
                Components\Toggle::make('is_published')
                    ->required()
                    ->default(true),
            ]);
    }
}
