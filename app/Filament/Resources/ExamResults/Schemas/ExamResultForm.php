<?php

namespace App\Filament\Resources\ExamResults\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ExamResultForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Select::make('paper_id')
                    ->relationship('paper', 'title')
                    ->required(),
                TextInput::make('exam_name')
                    ->required(),
                DatePicker::make('date')
                    ->required(),
                TextInput::make('obtained_marks')
                    ->required()
                    ->numeric(),
                TextInput::make('total_marks')
                    ->required()
                    ->numeric()
                    ->default(100),
                TextInput::make('grade')
                    ->required(),
            ]);
    }
}
