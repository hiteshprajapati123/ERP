<?php

namespace App\Filament\Resources\Sadqas;

use App\Filament\Resources\Sadqas\Pages\CreateSadqa;
use App\Filament\Resources\Sadqas\Pages\EditSadqa;
use App\Filament\Resources\Sadqas\Pages\ListSadqas;
use App\Filament\Resources\Sadqas\Schemas\SadqaForm;
use App\Filament\Resources\Sadqas\Tables\SadqasTable;
use App\Models\Sadqa;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SadqaResource extends Resource
{
    protected static ?string $model = Sadqa::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-heart';

    protected static string|\UnitEnum|null $navigationGroup = 'Donation';
    
    protected static ?int $navigationSort = 3;
    
    protected static ?string $recordTitleAttribute = 'Sadqa';

    public static function form(Schema $schema): Schema
    {
        return SadqaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SadqasTable::configure($table);
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
            'index' => ListSadqas::route('/'),
            // 'create' => CreateSadqa::route('/create'),
            'edit' => EditSadqa::route('/{record}/edit'),
        ];
    }
}
