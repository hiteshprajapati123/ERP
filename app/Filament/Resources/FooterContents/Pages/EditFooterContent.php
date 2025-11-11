<?php

namespace App\Filament\Resources\FooterContents\Pages;

use App\Filament\Resources\FooterContents\FooterContentResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFooterContent extends EditRecord
{
    protected static string $resource = FooterContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // DeleteAction::make(),
        ];
    }
}
