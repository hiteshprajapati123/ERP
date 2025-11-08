<?php

namespace App\Filament\Resources\NoticeCategories;

use App\Filament\Resources\NoticeCategories\Pages\CreateNoticeCategory;
use App\Filament\Resources\NoticeCategories\Pages\EditNoticeCategory;
use App\Filament\Resources\NoticeCategories\Pages\ListNoticeCategories;
use App\Filament\Resources\NoticeCategories\Schemas\NoticeCategoryForm;
use App\Filament\Resources\NoticeCategories\Tables\NoticeCategoriesTable;
use App\Models\NoticeCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class NoticeCategoryResource extends Resource
{
    protected static ?string $model = NoticeCategory::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';
    
    protected static string|\UnitEnum|null $navigationGroup = 'Categories';
    
    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return NoticeCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return NoticeCategoriesTable::configure($table);
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
            'index' => ListNoticeCategories::route('/'),
            'create' => CreateNoticeCategory::route('/create'),
            'edit' => EditNoticeCategory::route('/{record}/edit'),
        ];
    }
}
