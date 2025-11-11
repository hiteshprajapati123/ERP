<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1; // First widget
    protected int | string | array $columnSpan = 'full'; // Make it full width
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count())
                ->description('Total number of users')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success'),
                
            Stat::make('Admin Users', User::where('role', 'admin')->count())
                ->description('Number of admins')
                ->descriptionIcon('heroicon-m-shield-check')
                ->color('danger'),
                
            Stat::make('Student Users', User::where('role', 'user_student')->count())
                ->description('Number of students')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('info'),
                
            Stat::make('New Users (30d)', User::where('created_at', '>=', now()->subDays(30))->count())
                ->description('New users this month')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('warning'),
        ];
    }

    public static function canView(): bool
    {
        return true;
    }
}
