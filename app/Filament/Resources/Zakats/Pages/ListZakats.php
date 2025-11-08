<?php

namespace App\Filament\Resources\Zakats\Pages;

use App\Filament\Resources\Zakats\ZakatResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListZakats extends ListRecords
{
    protected static string $resource = ZakatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }
}
