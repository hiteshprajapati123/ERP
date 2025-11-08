<?php

namespace App\Filament\Resources\Users;

use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Filament\Resources\Users\Schemas\UserForm;
use App\Filament\Resources\Users\Tables\UsersTable;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-users';
    protected static string|\UnitEnum|null $navigationGroup = 'User Management';
    protected static ?int $navigationSort = 1;
    protected static ?string $recordTitleAttribute = 'name';
    
    public static function getNavigationGroup(): ?string
    {
        $userCount = static::getModel()::count();
        $queryCount = \App\Models\UserQuery::count();
        $total = $userCount + $queryCount;
        return 'User Management' . ($total > 0 ? " ({$total})" : '');
    }
    
    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::count();
    }

    public static function form(Schema $schema): Schema
    {
        return UserForm::configure($schema);
    }

    protected static function beforeCreate(array $data): array
    {
        if (!empty($data['password'])) {
        }
        
        // Remove password_confirmation as it's not needed in the database
        unset($data['password_confirmation']);
        
        // Set default role if not provided
        $data['role'] = $data['role'] ?? 'user_student';
        
        // Set email_verified_at for new users
        $data['email_verified_at'] = now();
        
        return $data;
    }

    protected static function beforeUpdate(array $data, $record): array
    {
        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }
        
        return $data;
    }

    public static function table(Table $table): Table
    {
        return UsersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }
}
