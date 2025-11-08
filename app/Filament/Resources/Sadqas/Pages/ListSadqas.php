<?php

namespace App\Filament\Resources\Sadqas\Pages;

use App\Filament\Resources\Sadqas\SadqaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSadqas extends ListRecords
{
    protected static string $resource = SadqaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }
}
