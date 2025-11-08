<?php

namespace App\Filament\Resources\Fitraas\Pages;

use App\Filament\Resources\Fitraas\FitraaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFitraa extends EditRecord
{
    protected static string $resource = FitraaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // DeleteAction::make(),
        ];
    }
}
