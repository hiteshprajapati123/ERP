<?php

namespace App\Filament\Resources\UserNotices;

use App\Filament\Resources\UserNotices\Pages\CreateUserNotice;
use App\Filament\Resources\UserNotices\Pages\EditUserNotice;
use App\Filament\Resources\UserNotices\Pages\ListUserNotices;
use App\Filament\Resources\UserNotices\Schemas\UserNoticeForm;
use App\Filament\Resources\UserNotices\Tables\UserNoticesTable;
use App\Models\UserNotice;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserNoticeResource extends Resource
{
    protected static ?string $model = UserNotice::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBell;
    
    protected static string|\UnitEnum|null $navigationGroup = 'User Side Pages';

    protected static ?string $recordTitleAttribute = 'User Notice';

    public static function form(Schema $schema): Schema
    {
        return UserNoticeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UserNoticesTable::configure($table);
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
            'index' => ListUserNotices::route('/'),
            'create' => CreateUserNotice::route('/create'),
            'edit' => EditUserNotice::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
