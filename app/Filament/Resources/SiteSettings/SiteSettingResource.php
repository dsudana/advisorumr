<?php

namespace App\Filament\Resources\SiteSettings;

use App\Filament\Resources\SiteSettings\Pages;
use App\Models\SiteSetting;
use BackedEnum;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables;
use Filament\Tables\Table;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-photo';
    protected static string|\UnitEnum|null $navigationGroup = 'System Settings';
    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Site Settings';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\Section::make('General Information')
                    ->schema([
                        Forms\Components\TextInput::make('site_name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('site_description')
                            ->rows(3)
                            ->maxLength(65535),
                    ]),
                Forms\Components\Section::make('Contact Details')
                    ->schema([
                        Forms\Components\TextInput::make('contact_email')
                            ->email()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('contact_phone')
                            ->tel()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('address')
                            ->rows(3)
                            ->maxLength(65535),
                        Forms\Components\Textarea::make('google_maps_embed')
                            ->label('Google Maps Embed Code (iframe)')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
                Forms\Components\Section::make('Social Media')
                    ->schema([
                        Forms\Components\TextInput::make('facebook_url')
                            ->url()
                            ->label('Facebook URL')
                            ->prefix('https://'),
                        Forms\Components\TextInput::make('instagram_url')
                            ->url()
                            ->label('Instagram URL')
                            ->prefix('https://'),
                        Forms\Components\TextInput::make('tiktok_url')
                            ->url()
                            ->label('TikTok URL')
                            ->prefix('https://'),
                        Forms\Components\TextInput::make('twitter_url')
                            ->url()
                            ->label('Twitter (X) URL')
                            ->prefix('https://'),
                        Forms\Components\TextInput::make('youtube_url')
                            ->url()
                            ->label('YouTube URL')
                            ->prefix('https://'),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('site_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contact_email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contact_phone'),
            ])
            ->filters([
                //
            ])
            ->actions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSiteSettings::route('/'),
        ];
    }
}
