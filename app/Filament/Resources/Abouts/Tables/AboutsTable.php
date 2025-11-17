<?php

namespace App\Filament\Resources\Abouts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class AboutsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('page_title')
                    ->searchable(),
                TextColumn::make('contact_address')
                    ->limit(20)
                    ->searchable(),
                TextColumn::make('contact_phone')
                    ->searchable(),
                TextColumn::make('contact_email')
                    ->searchable(),
                ToggleColumn::make('is_active'),
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
