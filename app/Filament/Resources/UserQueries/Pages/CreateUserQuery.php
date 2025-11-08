<?php

namespace App\Filament\Resources\UserQueries\Pages;

use App\Filament\Resources\UserQueries\UserQueryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUserQuery extends CreateRecord
{
    protected static string $resource = UserQueryResource::class;
}
