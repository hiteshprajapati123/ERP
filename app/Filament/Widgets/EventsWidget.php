<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use App\Models\Registration;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Illuminate\Support\Carbon;

class EventsWidget extends BaseWidget
{
    protected static ?int $sort = 2; // Second widget
    protected int | string | array $columnSpan = 'full'; // Make it full width

    protected function getStats(): array
    {
        try {
            $totalEvents = Event::count();
            $upcomingEvents = Event::where('event_date', '>=', now())->count();
            $totalRegistrations = Registration::count();
            $todayRegistrations = Registration::whereDate('created_at', today())->count();

            return [
                Stat::make('Total Events', $totalEvents)
                    ->description('Events in the system')
                    ->descriptionIcon('heroicon-o-calendar')
                    ->color('primary')
                    ->chart($this->getEventChartData()),

                Stat::make('Upcoming Events', $upcomingEvents)
                    ->description('Events yet to happen')
                    ->descriptionIcon('heroicon-o-clock')
                    ->color('info'),

                Stat::make('Total Registrations', $totalRegistrations)
                    ->description("$todayRegistrations today")
                    ->descriptionIcon('heroicon-o-user-group')
                    ->color('warning')
                    ->chart($this->getRegistrationChartData()),
            ];
            
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('EventsWidget Error: ' . $e->getMessage());
            
            return [
                Stat::make('Events', 'Error')
                    ->description($e->getMessage())
                    ->color('danger')
                    ->icon('heroicon-o-exclamation-triangle'),
            ];
        }
    }

    protected function getEventChartData(): array
    {
        try {
            $data = [];
            for ($i = 6; $i >= 0; $i--) {
                $date = now()->subDays($i);
                $count = Event::whereDate('created_at', $date->toDateString())->count();
                $data[] = $count;
            }
            return $data;
        } catch (\Exception $e) {
            return [0, 0, 0, 0, 0, 0, 0];
        }
    }

    protected function getRegistrationChartData(): array
    {
        try {
            $data = [];
            for ($i = 6; $i >= 0; $i--) {
                $date = now()->subDays($i);
                $count = Registration::whereDate('created_at', $date->toDateString())->count();
                $data[] = $count;
            }
            return $data;
        } catch (\Exception $e) {
            return [0, 0, 0, 0, 0, 0, 0];
        }
    }

    protected function getAverageAttendance(): int
    {
        try {
            $events = Event::where('registration_required', true)
                ->where('event_date', '<', now())
                ->withCount('registrations')
                ->get();

            if ($events->isEmpty()) {
                return 0;
            }

            $totalAttendance = 0;
            $totalEvents = 0;

            foreach ($events as $event) {
                if ($event->max_attendees > 0) {
                    $attendance = min(100, (int) (($event->registrations_count / $event->max_attendees) * 100));
                    $totalAttendance += $attendance;
                    $totalEvents++;
                }
            }

            return $totalEvents > 0 ? (int) ($totalAttendance / $totalEvents) : 0;
        } catch (\Exception $e) {
            return 0;
        }
    }

    public static function canView(): bool
    {
        return true; // Or add your permission check here
    }
}
