<?php

namespace App\Filament\Resources\FooterContents;

use App\Filament\Resources\FooterContents\Pages\CreateFooterContent;
use App\Filament\Resources\FooterContents\Pages\EditFooterContent;
use App\Filament\Resources\FooterContents\Pages\ListFooterContents;
use App\Filament\Resources\FooterContents\Schemas\FooterContentForm;
use App\Filament\Resources\FooterContents\Tables\FooterContentsTable;
use App\Models\FooterContent;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FooterContentResource extends Resource
{
    protected static ?string $model = FooterContent::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';
    
    protected static string|\UnitEnum|null $navigationGroup = 'Site Setting';
    
    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'title';
    
    protected static ?string $navigationLabel = 'Footer Content';

    public static function form(Schema $schema): Schema
    {
        return FooterContentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FooterContentsTable::configure($table);
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
            'index' => ListFooterContents::route('/'),
            // 'create' => CreateFooterContent::route('/create'),
            'edit' => EditFooterContent::route('/{record}/edit'),
        ];
    }
}
