<?php

namespace App\Filament\Resources\UserQueries;

use App\Filament\Resources\UserQueries\Pages\CreateUserQuery;
use App\Filament\Resources\UserQueries\Pages\EditUserQuery;
use App\Filament\Resources\UserQueries\Pages\ListUserQueries;
use App\Filament\Resources\UserQueries\Schemas\UserQueryForm;
use App\Filament\Resources\UserQueries\Tables\UserQueriesTable;
use App\Models\UserQuery;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class UserQueryResource extends Resource
{
    protected static ?string $model = UserQuery::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static string|\UnitEnum|null $navigationGroup = 'User Management';
    protected static ?int $navigationSort = 2;
    protected static ?string $recordTitleAttribute = 'User Query';
    
    public static function getNavigationGroup(): ?string
    {
        $userCount = \App\Models\User::count();
        $queryCount = static::getModel()::count();
        $total = $userCount + $queryCount;
        return 'User Management' . ($total > 0 ? " ({$total})" : '');
    }
    
    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::count();
    }

    public static function form(Schema $schema): Schema
    {
        return UserQueryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UserQueriesTable::configure($table);
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
            'index' => ListUserQueries::route('/'),
            // 'create' => CreateUserQuery::route('/create'),
            'edit' => EditUserQuery::route('/{record}/edit'),
        ];
    }
}
