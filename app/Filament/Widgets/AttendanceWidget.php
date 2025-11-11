<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class AttendanceWidget extends BaseWidget
{
    protected static ?int $sort = 4; // Fourth widget
    protected function getColumns(): int
    {
        return 3;
    }
    
    protected function getStats(): array
    {
        return [
            Stat::make('Today\'s Attendance', '')
                ->description('View and manage attendance')
                ->descriptionIcon('heroicon-o-calendar')
                ->color('primary')
                ->url('Madarsa-AdminSide/attendances')
                ->extraAttributes([
                    'class' => 'cursor-pointer hover:shadow-md transition-shadow',
                ]),

            Stat::make('Exam Schedule', '')
                ->description('View and manage exam schedule')
                ->descriptionIcon('heroicon-o-calendar')
                ->color('secondary')
                ->url('/Madarsa-AdminSide/exam-results')
                ->extraAttributes([
                    'class' => 'cursor-pointer hover:shadow-md transition-shadow',
            ]),

            Stat::make('Collect Fees', '')
                ->description('Record fee payments')
                ->descriptionIcon('heroicon-o-banknotes')
                ->color('info')
                ->url('/Madarsa-AdminSide/fees')
                ->extraAttributes([
                    'class' => 'cursor-pointer hover:shadow-md transition-shadow',
                ]),
        ];
    }

    public static function canView(): bool
    {
        return true;
    }
}
