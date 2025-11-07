<?php

namespace App\Filament\Resources\PrivacyPolicies\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PrivacyPolicyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('subtitle')
                    ->required(),
                Textarea::make('introduction')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('info_we_collect')
                    ->columnSpanFull(),
                Textarea::make('how_we_use')
                    ->columnSpanFull(),
                Textarea::make('data_protection')
                    ->columnSpanFull(),
                Textarea::make('your_rights')
                    ->columnSpanFull(),
                Textarea::make('updates_to_policy')
                    ->columnSpanFull(),
                TextInput::make('sections'),
                TextInput::make('last_updated')
                    ->required(),
                DatePicker::make('last_updated_date'),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
