<?php

namespace App\Filament\Resources\MaintenanceSettings\Pages;

use App\Filament\Resources\MaintenanceSettings\MaintenanceSettingsResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMaintenanceSettings extends EditRecord
{
    protected static string $resource = MaintenanceSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // DeleteAction::make(),
        ];
    }
}
