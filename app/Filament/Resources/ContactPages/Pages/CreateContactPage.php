<?php

namespace App\Filament\Resources\ContactPages\Pages;

use App\Filament\Resources\ContactPages\ContactPageResource;
use Filament\Resources\Pages\CreateRecord;

class CreateContactPage extends CreateRecord
{
    protected static string $resource = ContactPageResource::class;
}
