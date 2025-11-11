<?php

namespace App\Filament\Resources\Attendances\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class AttendanceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name'),
                DatePicker::make('date')
                    ->required(),
                Select::make('status')
                    ->options(['present' => 'Present', 'absent' => 'Absent', 'holiday' => 'Holiday']),
                Textarea::make('notes')
                    ->columnSpanFull(),
            ]);
    }
}
