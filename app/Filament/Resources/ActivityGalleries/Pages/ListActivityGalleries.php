<?php

namespace App\Filament\Resources\ActivityGalleries\Pages;

use App\Filament\Resources\ActivityGalleries\ActivityGalleryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListActivityGalleries extends ListRecords
{
    protected static string $resource = ActivityGalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
