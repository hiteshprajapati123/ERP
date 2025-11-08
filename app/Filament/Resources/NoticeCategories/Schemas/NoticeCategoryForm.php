<?php

namespace App\Filament\Resources\NoticeCategories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class NoticeCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->live(debounce: 500)
                    ->afterStateUpdated(function ($get, $set, $state) {
                        $set('slug', Str::slug($state));
                    }),
                TextInput::make('slug')
                    ->unique('notice_categories', 'slug', ignoreRecord: true)
                    ->dehydrated()
                    ->readOnly()
                    ->disabled(),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
