<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class SiteSettingsWidget extends BaseWidget
{
    protected static ?int $sort = 5; // Fifth widget
    protected function getColumns(): int
    {
        return 2; // Force 2 columns layout
    }
    
    protected function getStats(): array
    {
        return [
            Stat::make('Site Information', '')
                ->description('Manage site details')
                ->descriptionIcon('heroicon-o-cog')
                ->color('warning')
                ->url('/Madarsa-AdminSide/footer-contents')
                ->extraAttributes([
                    'class' => 'cursor-pointer hover:shadow-md transition-shadow',
                ]),
                
            Stat::make('Social Media', '')
                ->description('Manage social links')
                ->descriptionIcon('heroicon-o-share')
                ->color('danger')
                ->url('/Madarsa-AdminSide/social-links')
                ->extraAttributes([
                    'class' => 'cursor-pointer hover:shadow-md transition-shadow',
                ]),
        ];
    }
    
    protected function getCardHeaderHtml(): ?string
    {
        return null; // Remove the default card header
    }

    public static function canView(): bool
    {
        return true;
    }
}
