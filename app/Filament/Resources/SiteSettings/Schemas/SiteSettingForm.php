<?php

namespace App\Filament\Resources\SiteSettings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SiteSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('school_name_primary')
                    ->label('Primary School Name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('school_name_secondary')
                    ->label('Secondary School Name')
                    ->maxLength(255),

                FileUpload::make('logo_path')
                    ->label('School Logo')
                    ->image()
                    ->disk('public')
                    ->directory('logos')
                    ->imageResizeMode('cover')
                    ->imageResizeTargetWidth(500)
                    ->imageResizeTargetHeight(500)
                    ->columnSpanFull(),
            ]);
    }
}

