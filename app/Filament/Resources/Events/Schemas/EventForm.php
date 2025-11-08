<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('image_url')
                    ->image()
                    ->disk('local')
                    ->directory('private/events')
                    ->visibility('private')
                    ->getUploadedFileNameForStorageUsing(fn ($file) => 'event-'.time().'-'.Str::random(8).'.'.$file->getClientOriginalExtension()),
                DateTimePicker::make('event_date')
                    ->required(),
                TimePicker::make('start_time')
                    ->required(),
                TimePicker::make('end_time')
                    ->required(),
                TextInput::make('location'),
                Textarea::make('address')
                    ->columnSpanFull(),
                Toggle::make('is_featured')
                    ->required(),
                Toggle::make('registration_required')
                    ->required(),
                TextInput::make('max_attendees')
                    ->numeric(),
                TextInput::make('slug')
                    ->required(),
            ]);
    }
}
