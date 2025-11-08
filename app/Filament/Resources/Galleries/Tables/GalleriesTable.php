<?php

namespace App\Filament\Resources\Galleries\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class GalleriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_url')
                    ->getStateUsing(function ($record) {
                        $path = $record->image_url;
                        if (!$path) return null;
                        $path = str_replace('\\', '/', $path);
                        $path = preg_replace('#^/?storage/app/#', '', $path);
                        $path = preg_replace('#^/?app/#', '', $path);
                        $path = ltrim($path, '/');
                        return $path ? route('galleries.image', ['path' => $path]) : null;
                    }),
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('galleryCategory.name')
                    ->label('Category')
                    ->searchable(),
                ToggleColumn::make('is_featured')
                    ->label('Featured')
                    ->sortable(),
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
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
