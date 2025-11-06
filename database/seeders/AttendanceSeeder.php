<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    public function run(): void
    {
        // Get all users
        $users = User::all();
        
        if ($users->isEmpty()) {
            $this->command->info('No users found. Please run UserSeeder first.');
            return;
        }

        $today = now();
        $currentMonth = $today->month;
        $currentYear = $today->year;

        // Define some holidays for the current month (example: 1st and 15th)
        $holidays = collect([
            Carbon::create($currentYear, $currentMonth, 1),
            Carbon::create($currentYear, $currentMonth, 15)
        ]);

        foreach ($users as $user) {
            // Generate attendance for each day of the current month up to today
            for ($day = 1; $day <= $today->day; $day++) {
                $date = Carbon::create($currentYear, $currentMonth, $day);
                
                // Skip weekends (Saturday and Sunday)
                if ($date->isWeekend()) {
                    continue;
                }

                // Check if this is a holiday
                $isHoliday = $holidays->contains(function ($holiday) use ($date) {
                    return $holiday->isSameDay($date);
                });

                if ($isHoliday) {
                    // Create holiday record
                    Attendance::updateOrCreate(
                        [
                            'user_id' => $user->id, 
                            'date' => $date->format('Y-m-d')
                        ],
                        [
                            'status' => 'holiday',
                            'notes' => $this->getHolidayNote($date)
                        ]
                    );
                } else {
                    // Regular attendance record
                    $status = $this->getRandomStatus($date);
                    $notes = $this->getStatusNote($status, $date);
                    
                    // Create or update attendance record
                    Attendance::updateOrCreate(
                        [
                            'user_id' => $user->id, 
                            'date' => $date->format('Y-m-d')
                        ],
                        [
                            'status' => $status,
                            'notes' => $notes
                        ]
                    );
                }
            }
        }
    }

    /**
     * Generate a random status for attendance
     */
    private function getRandomStatus(Carbon $date): string
    {
        // 95% chance of being present, 5% absent
        $random = rand(1, 100);
        
        if ($random <= 95) return 'present';
        return 'absent';
    }
    
    /**
     * Get a note based on the status
     */
    private function getStatusNote(string $status, Carbon $date): ?string
    {
        $notes = [
            'present' => [
                'Regular work day',
                'Completed all tasks',
                'Full day of work',
                'Productive day',
                'Attended all meetings'
            ],
            'absent' => [
                'Sick leave',
                'Personal emergency',
                'Family matter',
                'Medical appointment',
                'Unauthorized absence'
            ],
            'holiday' => [
                'Public holiday',
                'National holiday',
                'Religious holiday',
                'Bank holiday',
                'Official holiday'
            ]
        ];
        
        if (!isset($notes[$status])) {
            return null;
        }
        
        $randomNote = $notes[$status][array_rand($notes[$status])];
        return $randomNote . ' - ' . $date->format('M d, Y');
    }
    
    /**
     * Generate a random holiday note
     */
    private function getHolidayNote(Carbon $date): string
    {
        $holidays = [
            'Public Holiday',
            'National Day',
            'Religious Festival',
            'Bank Holiday',
            'Official Holiday',
            'Cultural Celebration',
            'Independence Day',
            'New Year\'s Day',
            'Eid al-Fitr',
            'Christmas Day'
        ];
        
        return $holidays[array_rand($holidays)] . ' - ' . $date->format('M d, Y');
    }
}
