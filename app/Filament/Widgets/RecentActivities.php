<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Carbon\Carbon;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;

class RecentActivities extends TableWidget
{
    protected static ?int $sort = 3; // Third widget
    protected int | string | array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        return User::query()
            ->latest()
            ->limit(5);
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
                ->color('danger'),
                
            TextColumn::make('created_at')
                ->label('Joined')
                ->dateTime('M j, Y')
                ->sortable()
                ->color('warning'),
                
            TextColumn::make('last_login_at')
                ->label('Last Active')
                ->formatStateUsing(fn ($state) => $state ? Carbon::parse($state)->diffForHumans() : 'Never')
                ->sortable(),
        ];
    }

    public static function canView(): bool
    {
        return true;
    }
}
