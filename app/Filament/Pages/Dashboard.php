<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;

class Dashboard extends BaseDashboard
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-home';

    protected string $view = 'filament.pages.dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            // Hero Slides
            \App\Filament\Widgets\HeroSlidesWidget::class,
            
            // Events & Registrations
            \App\Filament\Widgets\EventsWidget::class,
            
            // Site Settings
            \App\Filament\Widgets\SiteSettingsWidget::class,
            
            // Attendance
            \App\Filament\Widgets\AttendanceWidget::class,
            
            // Stats Overview
            \App\Filament\Widgets\StatsOverview::class,
            
            // Recent Activities
            \App\Filament\Widgets\RecentActivities::class,
        ];
    }

    public function getHeaderWidgetsColumns(): int | array
    {
        return 1;
    }
}
