<?php

namespace App\Filament\Resources\ContactPages;

use App\Filament\Resources\ContactPages\Pages\CreateContactPage;
use App\Filament\Resources\ContactPages\Pages\EditContactPage;
use App\Filament\Resources\ContactPages\Pages\ListContactPages;
use App\Filament\Resources\ContactPages\Schemas\ContactPageForm;
use App\Filament\Resources\ContactPages\Tables\ContactPagesTable;
use App\Models\ContactPage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactPageResource extends Resource
{
    protected static ?string $model = ContactPage::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-phone';

    protected static string|\UnitEnum|null $navigationGroup = 'Front Pages';

    protected static ?string $recordTitleAttribute = 'Contact-Page';

    public static function form(Schema $schema): Schema
    {
        return ContactPageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ContactPagesTable::configure($table);
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
            'index' => ListContactPages::route('/'),
            'edit' => EditContactPage::route('/{record}/edit'),
        ];
    }
}
