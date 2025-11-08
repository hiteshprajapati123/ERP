<?php

namespace App\Filament\Resources\UserQueries\Pages;

use App\Filament\Resources\UserQueries\UserQueryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditUserQuery extends EditRecord
{
    protected static string $resource = UserQueryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
