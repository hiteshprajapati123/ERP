<?php

namespace App\Filament\Widgets;

use App\Models\UserQuery;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;

class UserQueriesTableWidget extends TableWidget
{
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        return UserQuery::query()
            ->latest()
            ->limit(3);
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('name')
                ->label('Name')
                ->searchable()
                ->sortable()
                ->color('primary'),
                
            TextColumn::make('email')
                ->label('Email')
                ->searchable()
                ->sortable()
                ->color('warning'),
                
            TextColumn::make('subject')
                ->label('Subject')
                ->searchable()
                ->sortable()
                ->limit(30)
                ->color('gray'),

            TextColumn::make('created_at')
                ->label('Submitted')
                ->dateTime('M j, Y')
                ->sortable()
                ->color('danger'),
        ];
    }

    public static function canView(): bool
    {
        return true; // Or set your permission logic here
    }
}
