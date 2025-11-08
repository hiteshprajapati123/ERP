<?php

namespace App\Filament\Resources\AboutSections\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AboutSectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('welcome_title')
                    ->required(),
                Textarea::make('welcome_content')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->image()
                    ->disk('private')
                    ->directory('about(homepage)')
                    ->imagePreviewHeight('220')
                    ->panelLayout('integrated')
                    ->getUploadedFileNameForStorageUsing(fn ($file): string => (string) str('about-home-' . now()->timestamp . '-' . uniqid() . '.' . $file->getClientOriginalExtension())),
                TextInput::make('quote_1_text')
                    ->required(),
                TextInput::make('quote_1_author')
                    ->required(),
                TextInput::make('quote_2_text')
                    ->required(),
                TextInput::make('quote_2_author')
                    ->required(),
                TextInput::make('button_text')
                    ->required(),
                Toggle::make('is_active')
                    ->required(),
                TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(1),
            ]);
    }
}
