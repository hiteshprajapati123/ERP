<?php

namespace App\Filament\Resources\MaintenanceSettings;

use App\Filament\Resources\MaintenanceSettings\Pages\CreateMaintenanceSettings;
use App\Filament\Resources\MaintenanceSettings\Pages\EditMaintenanceSettings;
use App\Filament\Resources\MaintenanceSettings\Pages\ListMaintenanceSettings;
use App\Filament\Resources\MaintenanceSettings\Schemas\MaintenanceSettingsForm;
use App\Filament\Resources\MaintenanceSettings\Tables\MaintenanceSettingsTable;
use App\Models\MaintenanceSettings;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MaintenanceSettingsResource extends Resource
{
    protected static ?string $model = MaintenanceSettings::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-bolt';

    protected static string|\UnitEnum|null $navigationGroup = 'Site Setting';

    protected static ?string $recordTitleAttribute = 'maintenance_settings';

    public static function form(Schema $schema): Schema
    {
        return MaintenanceSettingsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MaintenanceSettingsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMaintenanceSettings::route('/'),
            'create' => CreateMaintenanceSettings::route('/create'),
            'edit' => EditMaintenanceSettings::route('/{record}/edit'),
        ];
    }
}
