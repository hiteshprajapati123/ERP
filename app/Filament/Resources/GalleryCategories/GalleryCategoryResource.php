<?php

namespace App\Filament\Resources\GalleryCategories;

use App\Filament\Resources\GalleryCategories\Pages\CreateGalleryCategory;
use App\Filament\Resources\GalleryCategories\Pages\EditGalleryCategory;
use App\Filament\Resources\GalleryCategories\Pages\ListGalleryCategories;
use App\Filament\Resources\GalleryCategories\Schemas\GalleryCategoryForm;
use App\Filament\Resources\GalleryCategories\Tables\GalleryCategoriesTable;
use App\Models\GalleryCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Navigation\NavigationGroup;
use Filament\Tables\Table;

class GalleryCategoryResource extends Resource
{
    protected static ?string $model = GalleryCategory::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-tag';

    protected static string|\UnitEnum|null $navigationGroup = 'Categories';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return GalleryCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GalleryCategoriesTable::configure($table);
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
            'index' => ListGalleryCategories::route('/'),
            'create' => CreateGalleryCategory::route('/create'),
            'edit' => EditGalleryCategory::route('/{record}/edit'),
        ];
    }
}
