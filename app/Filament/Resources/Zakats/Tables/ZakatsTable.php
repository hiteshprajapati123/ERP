<?php

namespace App\Filament\Resources\Zakats\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class ZakatsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('hero_title')
                    ->searchable(),
                TextColumn::make('what_is_title')
                    ->searchable(),
                ImageColumn::make('what_is_image')
                    ->label('What Is Image')
                    ->getStateUsing(fn ($record) => $record->what_is_image ? route('zakat.files', $record->what_is_image) : null)
                    ->height(50)
                    ->width(50)
                    ->grow(false),
                TextColumn::make('donation_title')
                    ->searchable(),
                ImageColumn::make('qr_code_image')
                    ->label('QR Code')
                    ->getStateUsing(fn ($record) => $record->qr_code_image ? route('zakat.files', $record->qr_code_image) : null)
                    ->height(50)
                    ->width(50)
                    ->grow(false),
                TextColumn::make('nisab_gold')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('nisab_silver')
                    ->numeric()
                    ->sortable(),
                ToggleColumn::make('is_active')
                    ->label('Active')
                    ->onColor('success')
                    ->offColor('danger')
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
            ]);
            // ->toolbarActions([
            //     BulkActionGroup::make([
            //         DeleteBulkAction::make(),
            //     ]),
            // ]);
    }
}
