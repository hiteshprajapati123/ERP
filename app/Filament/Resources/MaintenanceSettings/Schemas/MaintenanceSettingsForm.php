<?php

namespace App\Filament\Resources\MaintenanceSettings\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class MaintenanceSettingsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Toggle::make('is_enabled')
                    ->label('Enable Maintenance Mode')
                    ->helperText('When enabled, the website will show a maintenance page to all visitors except administrators.')
                    ->required(),
                
                TextInput::make('title')
                    ->label('Maintenance Title')
                    ->required()
                    ->default('Website Under Maintenance')
                    ->placeholder('Enter maintenance page title')
                    ->maxLength(255),
                
                Textarea::make('message')
                    ->label('Maintenance Message')
                    ->required()
                    ->default('We are currently performing scheduled maintenance. We\'ll be back online shortly. Thank you for your patience!')
                    ->placeholder('Enter the message to display to visitors')
                    ->rows(4)
                    ->columnSpanFull(),
                
                TextInput::make('estimated_time')
                    ->label('Estimated Downtime')
                    ->placeholder('e.g., 2 hours, 1 day')
                    ->helperText('Optional: Inform visitors how long the maintenance might take')
                    ->maxLength(100),
                
                DateTimePicker::make('starts_at')
                    ->label('Maintenance Start Time')
                    ->helperText('Optional: Schedule when maintenance mode should automatically start'),
                
                DateTimePicker::make('ends_at')
                    ->label('Maintenance End Time')
                    ->helperText('Optional: Schedule when maintenance mode should automatically end'),
                
                TextInput::make('contact_email')
                    ->label('Contact Email')
                    ->email()
                    ->placeholder('support@example.com')
                    ->helperText('Optional: Email for urgent inquiries during maintenance'),
                
                TextInput::make('contact_phone')
                    ->label('Contact Phone')
                    ->tel()
                    ->placeholder('+1 234 567 8900')
                    ->helperText('Optional: Phone number for urgent inquiries during maintenance'),
            ]);
    }
}
