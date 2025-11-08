<?php

namespace App\Filament\Resources\ContactPages\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class ContactPagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('address')
                    ->limit(20)
                    ->label('Address')
                    ->tooltip(fn ($record) => $record->address)
                    ->searchable(),
                TextColumn::make('phone1')
                    ->label('Phone-1')
                    ->searchable(),
                TextColumn::make('phone2')
                    ->label('Phone-2')
                    ->searchable(),
                TextColumn::make('email1')
                    ->label('Email-1')
                    ->limit(15)
                    ->tooltip(fn ($record) => $record->email1)
                    ->searchable(),
                TextColumn::make('email2')
                    ->label('Email-2')
                    ->limit(15)
                    ->tooltip(fn ($record) => $record->email2)
                    ->searchable(),
                ToggleColumn::make('is_active')
                    ->label('Active')
                    ->onColor('success')
                    ->offColor('danger'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
            ]);
            // ->toolbarActions([
            //     BulkActionGroup::make([
            //         DeleteBulkAction::make(),
            //         ForceDeleteBulkAction::make(),
            //         RestoreBulkAction::make(),
            //     ]),
            // ]);
    }
}
