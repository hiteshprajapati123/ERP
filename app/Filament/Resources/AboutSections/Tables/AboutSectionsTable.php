<?php

namespace App\Filament\Resources\AboutSections\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class AboutSectionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('welcome_title')
                    ->searchable(),
                ToggleColumn::make('is_active')
                    ->label('Is active')
                    ->onColor('success')
                    ->offColor('danger'),
                ImageColumn::make('image'),
                TextColumn::make('quote_1_text')
                    ->searchable(),
                TextColumn::make('quote_1_author')
                    ->searchable(),
                TextColumn::make('quote_2_text')
                    ->searchable(),
                TextColumn::make('quote_2_author')
                    ->searchable(),
                TextColumn::make('button_text')
                    ->searchable(),
                TextColumn::make('order')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ]); // If you want to add bulk actions, uncomment the following line and remove column from here
            // ->toolbarActions([
            //     BulkActionGroup::make([
            //         DeleteBulkAction::make(),
            //     ]),
            // ]);
    }
}
