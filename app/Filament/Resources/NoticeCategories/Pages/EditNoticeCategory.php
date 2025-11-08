<?php

namespace App\Filament\Resources\NoticeCategories\Pages;

use App\Filament\Resources\NoticeCategories\NoticeCategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditNoticeCategory extends EditRecord
{
    protected static string $resource = NoticeCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
