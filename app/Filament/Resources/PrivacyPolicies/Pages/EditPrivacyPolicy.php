<?php

namespace App\Filament\Resources\PrivacyPolicies\Pages;

use App\Filament\Resources\PrivacyPolicies\PrivacyPolicyResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPrivacyPolicy extends EditRecord
{
    protected static string $resource = PrivacyPolicyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // DeleteAction::make(),
        ];
    }
}
