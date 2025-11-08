<?php

namespace App\Filament\Resources\Zakats;

use App\Filament\Resources\Zakats\Pages\CreateZakat;
use App\Filament\Resources\Zakats\Pages\EditZakat;
use App\Filament\Resources\Zakats\Pages\ListZakats;
use App\Filament\Resources\Zakats\Schemas\ZakatForm;
use App\Filament\Resources\Zakats\Tables\ZakatsTable;
use App\Models\Zakat;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ZakatResource extends Resource
{
    protected static ?string $model = Zakat::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-currency-dollar';
    
    protected static string|\UnitEnum|null $navigationGroup = 'Donation';
    
    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'hero_title';

    public static function form(Schema $schema): Schema
    {
        return ZakatForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ZakatsTable::configure($table);
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
            'index' => ListZakats::route('/'),
            // 'create' => CreateZakat::route('/create'),
            'edit' => EditZakat::route('/{record}/edit'),
        ];
    }
}
