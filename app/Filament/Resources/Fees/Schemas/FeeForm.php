<?php

namespace App\Filament\Resources\Fees\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class FeeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Student/User')
                    ->relationship('user', 'name')
                    ->required()
                    ->placeholder('Select a student'),

                TextInput::make('month_year')
                    ->label('Month & Year')
                    ->placeholder('e.g., 2024-01')
                    ->required()
                    ->maxLength(7)
                    ->helperText('Format: YYYY-MM (e.g., 2024-01 for January 2024)'),

                Textarea::make('description')
                    ->label('Description')
                    ->placeholder('Describe what this fee is for...')
                    ->rows(3)
                    ->columnSpanFull()
                    ->maxLength(500),

                TextInput::make('amount')
                    ->label('Amount (₹)')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->step(0.01)
                    ->prefix('₹')
                    ->placeholder('0.00'),

                DatePicker::make('due_date')
                    ->label('Due Date')
                    ->required()
                    ->default(now()->addDays(30))
                    ->minDate(now())
                    ->displayFormat('M j, Y'),

                Select::make('status')
                    ->label('Payment Status')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'overdue' => 'Overdue',
                        'cancelled' => 'Cancelled',
                    ])
                    ->default('pending')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        if ($state === 'paid') {
                            $set('paid_date', now()->format('Y-m-d'));
                        } elseif ($state === 'pending') {
                            $set('paid_date', null);
                        }
                    }),

                DatePicker::make('paid_date')
                    ->label('Payment Date')
                    ->visible(fn ($get) => $get('status') === 'paid')
                    ->required(fn ($get) => $get('status') === 'paid')
                    ->default(now())
                    ->displayFormat('M j, Y'),
            ]);
    }
}
