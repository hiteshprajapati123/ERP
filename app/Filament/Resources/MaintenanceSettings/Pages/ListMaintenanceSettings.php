<?php

namespace App\Filament\Resources\MaintenanceSettings\Pages;

use App\Filament\Resources\MaintenanceSettings\MaintenanceSettingsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMaintenanceSettings extends ListRecords
{
    protected static string $resource = MaintenanceSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }
}
