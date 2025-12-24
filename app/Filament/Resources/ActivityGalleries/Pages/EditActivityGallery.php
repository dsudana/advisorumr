<?php

namespace App\Filament\Resources\ActivityGalleries\Pages;

use App\Filament\Resources\ActivityGalleries\ActivityGalleryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditActivityGallery extends EditRecord
{
    protected static string $resource = ActivityGalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
