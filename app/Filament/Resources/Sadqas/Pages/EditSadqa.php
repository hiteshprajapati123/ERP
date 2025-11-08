<?php

namespace App\Filament\Resources\Sadqas\Pages;

use App\Filament\Resources\Sadqas\SadqaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSadqa extends EditRecord
{
    protected static string $resource = SadqaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // DeleteAction::make(),
        ];
    }
}
