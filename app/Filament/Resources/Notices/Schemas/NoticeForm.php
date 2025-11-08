<?php

namespace App\Filament\Resources\Notices\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class NoticeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                Textarea::make('description')
                    ->rows(4)
                    ->columnSpanFull(),
                Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                DatePicker::make('notice_date')
                    ->required(),
                DatePicker::make('expiry_date'),
                Toggle::make('is_published')
                    ->required(),
                FileUpload::make('file_path')
                    ->label('Attachment (PDF/DOC/DOCX/ZIP/Images)')
                    ->disk('private')
                    ->directory('notices/files')
                    ->preserveFilenames(false)
                    ->acceptedFileTypes([
                        'application/pdf',
                        'application/msword',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        'application/zip',
                        'application/x-zip-compressed',
                        'image/jpeg', 'image/png', 'image/webp', 'image/gif'
                    ])
                    ->getUploadedFileNameForStorageUsing(fn ($file): string => (string) str('notice-file-' . now()->timestamp . '-' . uniqid() . '.' . $file->getClientOriginalExtension()))
                    ->afterStateUpdated(function ($state, callable $set) {
                        if ($state && method_exists($state, 'getClientOriginalName')) {
                            $set('file_name', $state->getClientOriginalName());
                            $set('file_type', $state->getClientMimeType());
                            $set('file_size', $state->getSize());
                        }
                    }),
                FileUpload::make('image_path')
                    ->label('Notice Image')
                    ->image()
                    ->disk('private')
                    ->directory('notices/img')
                    ->preserveFilenames(false)
                    ->getUploadedFileNameForStorageUsing(fn ($file): string => (string) str('notice-image-' . now()->timestamp . '-' . uniqid() . '.' . $file->getClientOriginalExtension())),
                TextInput::make('file_name'),
                TextInput::make('file_size'),
                TextInput::make('file_type'),
                TextInput::make('contact_person'),
                TextInput::make('contact_email')
                    ->email(),
                TextInput::make('contact_phone')
                    ->tel(),
                TextInput::make('location'),
                DateTimePicker::make('event_date')
                    ->required(),                
            ]);
    }
}
