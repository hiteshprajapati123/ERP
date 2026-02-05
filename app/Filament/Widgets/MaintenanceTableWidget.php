<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\MaintenanceSettings\MaintenanceSettingsResource;
use App\Models\MaintenanceSettings;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\Action;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Notifications\Notification;

class MaintenanceTableWidget extends BaseWidget
{
    protected static ?int $sort = 1;
    
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                MaintenanceSettings::query()
            )
            ->columns([
                Tables\Columns\ToggleColumn::make('is_enabled')
                    ->label('Status')
                    ->onColor('success')
                    ->offColor('danger')
                    ->updateStateUsing(function ($state, $record) {
                        $record->is_enabled = $state;
                        $record->save();
                        
                        Notification::make()
                            ->title('Maintenance mode ' . ($state ? 'enabled' : 'disabled') . '!')
                            ->success()
                            ->send();
                            
                        return $state;
                    }),
                    
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->limit(50),
                    
                Tables\Columns\TextColumn::make('estimated_time')
                    ->label('Estimated Time')
                    ->placeholder('Not set')
                    ->badge()
                    ->color('info'),
                    
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime('M j, Y g:i A')
                    ->sortable(),
            ])
            ->actions([
                EditAction::make()
                    ->url(fn ($record) => MaintenanceSettingsResource::getUrl('edit', ['record' => $record]))
                    ->label('Edit'),
                    
                Action::make('quick_toggle')
                    ->label('Quick Toggle')
                    ->icon('heroicon-o-power')
                    ->color(fn ($record) => $record->is_enabled ? 'danger' : 'success')
                    ->action(function ($record) {
                        $record->is_enabled = !$record->is_enabled;
                        $record->save();
                        
                        Notification::make()
                            ->title('Maintenance mode ' . ($record->is_enabled ? 'enabled' : 'disabled') . '!')
                            ->success()
                            ->send();
                    }),
            ])
            ->paginated([5, 10, 25])
            ->searchable()
            ->poll('30s');
    }
}
