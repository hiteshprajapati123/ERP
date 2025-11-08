<?php

namespace App\Filament\Resources\NoticeCategories\Pages;

use App\Filament\Resources\NoticeCategories\NoticeCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListNoticeCategories extends ListRecords
{
    protected static string $resource = NoticeCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
