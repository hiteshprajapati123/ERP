<?php

namespace App\Filament\Resources\MaintenanceSettings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class MaintenanceSettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ToggleColumn::make('is_enabled')
                    ->label('Enabled')
                    ->action(fn ($record, $state) => $record->update(['is_enabled' => $state])
                        ? toast('Maintenance setting updated!', 'success')
                        : null
                    ),
                TextColumn::make('status')
                    ->label('Status')
                    ->getStateUsing(fn ($record) => $record->is_enabled ? 'Enabled' : 'Disabled')
                    ->badge()
                    ->color(fn ($record) => $record->is_enabled ? 'success' : 'danger'),
                TextColumn::make('title')
                    ->label('Mainte... Title')
                    ->limit(10)
                    ->searchable(),
                TextColumn::make('estimated_time')
                    ->label('Mainte... Duration')
                    ->searchable(),
                TextColumn::make('starts_at')
                    ->label('Starts At')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('ends_at')
                    ->label('Ends At')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('contact_email')
                    ->label('Contact Email')
                    ->searchable(),
                TextColumn::make('contact_phone')
                    ->label('Contact Phone')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Updated At')
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
