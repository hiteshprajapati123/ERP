<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Basic Information
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                    
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                    
                TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->maxLength(20),
                    
                // Password (only show on create or when explicitly changing)
                TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $context): bool => $context === 'create')
                    ->minLength(8)
                    ->same('password_confirmation')
                    ->maxLength(255),
                    
                TextInput::make('password_confirmation')
                    ->required()
                    ->password()
                    ->label('Confirm Password')
                    ->requiredWith('password')
                    ->dehydrated(false)
                    ->maxLength(255),
                    
                // Personal Information
                TextInput::make('roll_number')
                    ->hint('Roll Number Always be unique not same as another user')
                    ->required()
                    ->maxLength(50),
                    
                Select::make('role')
                    ->options([
                        'admin' => 'Admin',
                        'user_student' => 'Student',
                    ])
                    ->columnSpanFull()
                    ->default('user_student')
                    ->required(),

                TextInput::make('father_name')
                    ->maxLength(255),
                    
                TextInput::make('mother_name')
                    ->maxLength(255),
                    
                DatePicker::make('date_of_birth')
                    ->maxDate(now()),
                    
                Select::make('gender')
                    ->options([
                        'male' => 'Male',
                        'female' => 'Female', 
                        'other' => 'Other'
                    ]),
                    
                // Address
                Textarea::make('address')
                    ->columnSpanFull(),
                    
                TextInput::make('city')
                    ->maxLength(100),
                    
                TextInput::make('state')
                    ->maxLength(100),
                    
                TextInput::make('pincode')
                    ->numeric()
                    ->maxLength(10),
                    
                // Profile & Role
                FileUpload::make('photo')
                    ->image()
                    ->directory('user-photos')
                    ->imageEditor(),
            ]);
    }
}
