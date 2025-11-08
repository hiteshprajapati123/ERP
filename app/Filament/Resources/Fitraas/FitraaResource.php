<?php

namespace App\Filament\Resources\Fitraas;

use App\Filament\Resources\Fitraas\Pages\CreateFitraa;
use App\Filament\Resources\Fitraas\Pages\EditFitraa;
use App\Filament\Resources\Fitraas\Pages\ListFitraas;
use App\Filament\Resources\Fitraas\Schemas\FitraaForm;
use App\Filament\Resources\Fitraas\Tables\FitraasTable;
use App\Models\Fitraa;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FitraaResource extends Resource
{
    protected static ?string $model = Fitraa::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-gift';
    
    protected static string|\UnitEnum|null $navigationGroup = 'Donation';
    
    protected static ?string $navigationLabel = 'Fitraa';
    
    protected static ?int $navigationSort = 2;
    
    protected static ?string $recordTitleAttribute = 'Fitraa';

    public static function form(Schema $schema): Schema
    {
        return FitraaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FitraasTable::configure($table);
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
            'index' => ListFitraas::route('/'),
            // 'create' => CreateFitraa::route('/create'),
            'edit' => EditFitraa::route('/{record}/edit'),
        ];
    }
}
