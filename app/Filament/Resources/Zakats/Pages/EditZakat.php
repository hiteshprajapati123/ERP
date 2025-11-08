<?php

namespace App\Filament\Resources\Zakats\Pages;

use App\Filament\Resources\Zakats\ZakatResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditZakat extends EditRecord
{
    protected static string $resource = ZakatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // DeleteAction::make(),
        ];
    }
}
