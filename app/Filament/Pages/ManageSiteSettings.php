<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use Filament\Forms\Form;
use Filament\Schemas\Schema;
use Filament\Schemas;
use Filament\Forms;
use Filament\Pages\Page;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Storage;

class ManageSiteSettings extends Page
{
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected string $view = 'filament.pages.manage-site-settings';

    protected static string|\UnitEnum|null $navigationGroup = 'Settings';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = SiteSetting::firstOrCreate([
            'id' => 1
        ], [
            'site_name' => 'Umroh Travel',
        ]);

        $this->form->fill($settings->toArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                Schemas\Components\Section::make('General Information')
                    ->schema([
                        Forms\Components\TextInput::make('site_name')
                            ->required(),
                        Forms\Components\Textarea::make('site_description')
                            ->rows(3),
                        Forms\Components\TextInput::make('contact_phone'),
                        Forms\Components\TextInput::make('contact_email')
                            ->email(),
                        Forms\Components\Textarea::make('address')
                            ->rows(3),
                    ])->columns(2),

                Schemas\Components\Section::make('Branding')
                    ->schema([
                        Forms\Components\FileUpload::make('logo_path')
                            ->image()
                            ->directory('settings')
                            ->preserveFilenames(),
                        Forms\Components\FileUpload::make('favicon_path')
                            ->image()
                            ->directory('settings')
                            ->preserveFilenames(),
                    ])->columns(2),
            ]);
    }

    public function save(): void
    {
        $settings = SiteSetting::first();
        $settings->update($this->form->getState());

        Notification::make()
            ->title('Saved successfully')
            ->success()
            ->send();
    }
}
