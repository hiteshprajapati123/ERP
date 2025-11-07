<?php

namespace App\Filament\Resources\Abouts\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AboutForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('page_title')
                    ->required()
                    ->default('About Us'),
                Textarea::make('intro_content')
                    ->rows(4)
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('vision')
                    ->rows(4)
                    ->columnSpanFull(),
                Textarea::make('mission')
                    ->rows(4)
                    ->columnSpanFull(),
                Textarea::make('history_content')
                    ->rows(4)
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('what_we_offer')
                    ->rows(3)
                    ->hint('Separate items with commas, e.g., Item 1, Item 2')
                    ->placeholder('Item 1, Item 2, Item 3 or each on a new line')
                    ->formatStateUsing(fn ($state) => is_array($state) ? implode(', ', $state) : (string) $state)
                    ->dehydrateStateUsing(function ($state) {
                        if (is_array($state)) return $state;
                        $text = (string) $state;
                        $parts = preg_split("/(\r?\n|,)/", $text) ?: [];
                        return array_values(array_filter(array_map(fn ($v) => trim($v), $parts), fn ($v) => $v !== ''));
                    }),
                Textarea::make('highlights')
                    ->rows(3)
                    ->placeholder('Item 1, Item 2, Item 3 or each on a new line')
                    ->formatStateUsing(fn ($state) => is_array($state) ? implode(', ', $state) : (string) $state)
                    ->dehydrateStateUsing(function ($state) {
                        if (is_array($state)) return $state;
                        $parts = preg_split("/(\r?\n|,)/", (string) $state) ?: [];
                        return array_values(array_filter(array_map(fn ($v) => trim($v), $parts), fn ($v) => $v !== ''));
                    }),
                Textarea::make('programs')
                    ->rows(3)
                    ->placeholder('Item 1, Item 2, Item 3 or each on a new line')
                    ->formatStateUsing(fn ($state) => is_array($state) ? implode(', ', $state) : (string) $state)
                    ->dehydrateStateUsing(function ($state) {
                        if (is_array($state)) return $state;
                        $parts = preg_split("/(\r?\n|,)/", (string) $state) ?: [];
                        return array_values(array_filter(array_map(fn ($v) => trim($v), $parts), fn ($v) => $v !== ''));
                    }),
                Textarea::make('principal_message')
                    ->rows(4)
                    ->columnSpanFull(),
                TextInput::make('contact_address')
                    ->required(),
                TextInput::make('contact_phone')
                    ->tel()
                    ->required(),
                TextInput::make('contact_email')
                    ->email()
                    ->required(),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
