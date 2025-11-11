<?php

namespace App\Filament\Resources\UserNotices\Pages;

use App\Filament\Resources\UserNotices\UserNoticeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUserNotice extends CreateRecord
{
    protected static string $resource = UserNoticeResource::class;

    protected function afterCreate(): void
    {
        $record = $this->record;

        // Populate file information if file was uploaded
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
}
