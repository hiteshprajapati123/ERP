<?php

namespace App\Filament\Resources\UserNotices\Pages;

use App\Filament\Resources\UserNotices\UserNoticeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUserNotices extends ListRecords
{
    protected static string $resource = UserNoticeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
