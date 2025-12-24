<?php

namespace App\Filament\Resources\HeroImages\Pages;

use App\Filament\Resources\HeroImages\HeroImageResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditHeroImage extends EditRecord
{
    protected static string $resource = HeroImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
