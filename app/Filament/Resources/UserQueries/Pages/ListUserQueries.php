<?php

namespace App\Filament\Resources\UserQueries\Pages;

use App\Filament\Resources\UserQueries\UserQueryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUserQueries extends ListRecords
{
    protected static string $resource = UserQueryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }
}
