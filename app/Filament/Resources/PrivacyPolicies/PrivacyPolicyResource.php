<?php

namespace App\Filament\Resources\PrivacyPolicies;

use App\Filament\Resources\PrivacyPolicies\Pages\CreatePrivacyPolicy;
use App\Filament\Resources\PrivacyPolicies\Pages\EditPrivacyPolicy;
use App\Filament\Resources\PrivacyPolicies\Pages\ListPrivacyPolicies;
use App\Filament\Resources\PrivacyPolicies\Schemas\PrivacyPolicyForm;
use App\Filament\Resources\PrivacyPolicies\Tables\PrivacyPoliciesTable;
use App\Models\PrivacyPolicy;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PrivacyPolicyResource extends Resource
{
    protected static ?string $model = PrivacyPolicy::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-shield-check';

    protected static string|\UnitEnum|null $navigationGroup = 'Front Pages';

    protected static ?string $recordTitleAttribute = 'Privacy-Policy';

    public static function form(Schema $schema): Schema
    {
        return PrivacyPolicyForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PrivacyPoliciesTable::configure($table);
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
            'index' => ListPrivacyPolicies::route('/'),
            // 'create' => CreatePrivacyPolicy::route('/create'),
            'edit' => EditPrivacyPolicy::route('/{record}/edit'),
        ];
    }
}
