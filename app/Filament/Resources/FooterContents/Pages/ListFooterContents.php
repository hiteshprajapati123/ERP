<?php

namespace App\Filament\Resources\FooterContents\Pages;

use App\Filament\Resources\FooterContents\FooterContentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFooterContents extends ListRecords
{
    protected static string $resource = FooterContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }
}
