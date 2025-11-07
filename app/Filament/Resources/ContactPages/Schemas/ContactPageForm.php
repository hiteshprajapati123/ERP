<?php

namespace App\Filament\Resources\ContactPages\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ContactPageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('address')
                    ->label('Address')
                    ->required(),
                TextInput::make('phone1')
                    ->label('Phone-1')
                    ->tel()
                    ->required(),
                TextInput::make('phone2')
                    ->label('Phone-2')
                    ->tel(),
                TextInput::make('email1')
                    ->label('Email-1')
                    ->email()
                    ->required(),
                TextInput::make('email2')
                    ->label('Email-2')
                    ->email(),
                Toggle::make('is_active')
                    ->label('Active')
                    ->required(),
            ]);
    }
}
