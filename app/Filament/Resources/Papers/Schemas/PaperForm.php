<?php

namespace App\Filament\Resources\Papers\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PaperForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('subject')
                    ->required(),
                TextInput::make('year')
                    ->required(),
                TextInput::make('term')
                    ->required(),
                FileUpload::make('file_path')
                    ->label('Upload File')
                    ->disk('private')
                    ->directory('Exam-paper')
                    ->preserveFilenames(false)
                    ->acceptedFileTypes([
                        'application/pdf',
                        'application/msword',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        'application/zip', 'application/x-zip-compressed',
                        'image/jpeg','image/png','image/webp','image/gif'
                    ])
                    ->getUploadedFileNameForStorageUsing(fn ($file): string => (string) str('paper-' . now()->timestamp . '-' . uniqid() . '.' . $file->getClientOriginalExtension()))
                    ->required(),
            ]);
    }
}
