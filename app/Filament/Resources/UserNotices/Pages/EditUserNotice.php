<?php

namespace App\Filament\Resources\UserNotices\Pages;

use App\Filament\Resources\UserNotices\UserNoticeResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditUserNotice extends EditRecord
{
    protected static string $resource = UserNoticeResource::class;

    protected function afterSave(): void
    {
        $record = $this->record;

        // Populate file information if file was uploaded or changed
        if ($record->file_path) {
            $filePath = storage_path('app/' . $record->file_path);
            if (file_exists($filePath)) {
                $record->update([
                    'file_name' => $record->file_name ?: basename($record->file_path),
                    'file_size' => $record->file_size ?: filesize($filePath),
                    'file_type' => $record->file_type ?: mime_content_type($filePath),
                ]);
            }
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
