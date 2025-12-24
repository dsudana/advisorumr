<?php

namespace App\Filament\Resources\HeroImages\Pages;

use App\Filament\Resources\HeroImages\HeroImageResource;
use Filament\Resources\Pages\CreateRecord;

class CreateHeroImage extends CreateRecord
{
    protected static string $resource = HeroImageResource::class;
}
