<?php

namespace App\Filament\Resources\ActivityGalleries;

use App\Filament\Resources\ActivityGalleries\Pages\CreateActivityGallery;
use App\Filament\Resources\ActivityGalleries\Pages\EditActivityGallery;
use App\Filament\Resources\ActivityGalleries\Pages\ListActivityGalleries;
use App\Filament\Resources\ActivityGalleries\Schemas\ActivityGalleryForm;
use App\Filament\Resources\ActivityGalleries\Tables\ActivityGalleriesTable;
use App\Models\ActivityGallery;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;


class ActivityGalleryResource extends Resource
{
    protected static ?string $model = ActivityGallery::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-photo';
    protected static string|\UnitEnum|null $navigationGroup = 'Content Settings';

    // Actually, error said: MUST be UnitEnum|string|null. 
    // Let's try removing strict type override and just letting it assign.
    // Or specify: protected static string|\UnitEnum|null $navigationGroup = 'Content Settings';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return ActivityGalleryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ActivityGalleriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListActivityGalleries::route('/'),
            'create' => CreateActivityGallery::route('/create'),
            'edit' => EditActivityGallery::route('/{record}/edit'),
        ];
    }
}
