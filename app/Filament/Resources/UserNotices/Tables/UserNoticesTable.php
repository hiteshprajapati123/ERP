<?php

namespace App\Filament\Resources\UserNotices\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class UserNoticesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->limit(10)
                    ->label('Title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('noticeCategory.name')
                    ->label('Category')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('file_type')
                    ->label('File Type')
                    ->searchable(),
                TextColumn::make('publish_date')
                    ->label('Publish Date')
                    ->date()
                    ->sortable(),
                TextColumn::make('expiry_date')
                    ->label('Expiry Date')
                    ->date()
                    ->sortable(),
                ToggleColumn::make('is_pinned')
                    ->label('Pinned')
                    ->onColor('success')
                    ->offColor('danger'),
                ToggleColumn::make('is_important')
                    ->label('Important')
                    ->onColor('warning')
                    ->offColor('gray'),
                ToggleColumn::make('is_published')
                    ->label('Published')
                    ->onColor('primary')
                    ->offColor('danger')
                    ->afterStateUpdated(function ($record, $state) {
                        $record->update(['is_published' => $state]);
                    }),
                TextColumn::make('created_by')
                    ->label('Created By')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('notice_category_id')
                    ->relationship('noticeCategory', 'name')
                    ->searchable()
                    ->preload()
                    ->label('Category'),
                SelectFilter::make('is_published')
                    ->options([
                        '1' => 'Published',
                        '0' => 'Draft',
                    ])
                    ->label('Status'),
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