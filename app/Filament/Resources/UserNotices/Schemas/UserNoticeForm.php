<?php

namespace App\Filament\Resources\UserNotices\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class UserNoticeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, $set) {
                        if ($state) {
                            $set('slug', \Illuminate\Support\Str::slug($state));
                        }
                    }),
                Select::make('notice_category_id')
                    ->relationship('noticeCategory', 'name')
                    ->searchable()
                    ->preload()
                    ->label('Category')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('slug')
                    ->unique(ignoreRecord: true),
                Textarea::make('content')
                    ->required()
                    ->rows(6)
                    ->columnSpanFull(),
                // FileUpload::make('image_path')
                //     ->label('Image')
                //     ->image()
                //     ->directory('private/UserNotice/Image')
                //     ->visibility('private')
                //     ->preserveFilenames()
                //     ->openable(),
                FileUpload::make('file_path')
                    ->label('File')
                    ->directory('private/UserNotice/File')
                    ->visibility('private')
                    ->preserveFilenames()
                    ->openable()
                    ->helperText('Upload documents, PDFs, images, or other files. Maximum file size depends on server configuration.'),
                DatePicker::make('publish_date')
                    ->required(),
                DatePicker::make('expiry_date'),
                TextInput::make('created_by')
                    ->required()
                    ->numeric(),
                Toggle::make('is_pinned')
                    ->required(),
                Toggle::make('is_important')
                    ->required(),
                Toggle::make('is_published')
                    ->required(),
            ]);
    }
}
