<?php

namespace App\Filament\Resources\Events\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class EventsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->limit(15)
                    ->tooltip(fn ($state) => $state)
                    ->searchable(),
                ImageColumn::make('image_url')
                    ->getStateUsing(function ($record) {
                        if (!$record->image_url) return null;
                        $path = ltrim($record->image_url, '/');
                        if (str_starts_with($path, 'private/events/')) {
                            $path = substr($path, strlen('private/events/'));
                        }
                        return route('events.image', ['path' => $path]);
                    }),
                TextColumn::make('event_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('start_time')
                    ->time()
                    ->sortable(),
                TextColumn::make('end_time')
                    ->time()
                    ->sortable(),
                TextColumn::make('location')
                    ->limit(10)
                    ->tooltip(fn ($state) => $state)
                    ->searchable(),
                ToggleColumn::make('is_featured')
                    ->sortable(),
                ToggleColumn::make('registration_required')
                    ->sortable(),
                TextColumn::make('max_attendees')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
