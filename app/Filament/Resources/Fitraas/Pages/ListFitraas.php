<?php

namespace App\Filament\Resources\Fitraas\Pages;

use App\Filament\Resources\Fitraas\FitraaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFitraas extends ListRecords
{
    protected static string $resource = FitraaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }
}
