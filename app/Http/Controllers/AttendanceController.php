<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\UserActivity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    /**
     * Display the attendance dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));
        
        // Get attendance data for the selected month and year
        $attendanceData = $this->getMonthlyAttendance(Auth::id(), $month, $year);
        
        // Get attendance statistics using the new method
        $attendanceStats = $this->calculateAttendanceStats(Auth::id(), $month, $year);
        
        // Prepare months and years for the dropdown
        $months = [
            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
            5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
            9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
        ];
        
        $years = range(now()->year - 2, now()->year + 1);
        
        // Get recent attendance records
        $recentRecords = $this->getRecentAttendance(Auth::id());
        
        return view('user-dashboard.side-pages.attendance', [
            'attendanceData' => $attendanceData,
            'stats' => $attendanceStats,
            'recentRecords' => $recentRecords,
            'currentMonth' => (int)$month,
            'currentYear' => (int)$year,
            'months' => $months,
            'years' => $years,
        ]);
    }
    
    /**
     * Store a newly created attendance record.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'user_id' => 'nullable|exists:users,id',
            'status' => 'nullable|in:present,absent,holiday',
            'notes' => 'nullable|string|max:1000',
            'is_holiday' => 'sometimes|boolean',
            'holiday_name' => 'nullable|string|max:255'
        ]);

        $isHoliday = $request->filled('is_holiday') && $request->is_holiday;
        $attendanceData = [
            'date' => $validated['date'],
            'notes' => $validated['notes'] ?? null,
            'holiday_name' => $validated['holiday_name'] ?? null,
            'is_holiday' => $isHoliday
        ];

        // Handle holiday status
        if ($isHoliday) {
            $attendanceData['status'] = 'holiday';
            $attendanceData['notes'] = $attendanceData['notes'] ?? 'Public Holiday';
        } else {
            $attendanceData['status'] = $validated['status'] ?? null;
            $attendanceData['user_id'] = $validated['user_id'] ?? auth()->id();
        }

        // If it's a holiday, handle for all users
        if ($isHoliday) {
            // Get all user IDs
            $userIds = \App\Models\User::pluck('id');
            $createdRecords = collect();
            $today = now();

            // First create the global holiday record (user_id = null)
            $holidayRecord = Attendance::updateOrCreate(
                [
                    'user_id' => null,
                    'date' => $attendanceData['date']
                ],
                [
                    'status' => 'holiday',
                    'notes' => $attendanceData['notes'],
                    'holiday_name' => $attendanceData['holiday_name'],
                    'is_holiday' => true,
                    'created_by' => auth()->id()
                ]
            );
            
            // Then create/update for each user
            foreach ($userIds as $userId) {
                $record = Attendance::updateOrCreate(
                    [
                        'user_id' => $userId,
                        'date' => $attendanceData['date']
                    ],
                    [
                        'status' => 'holiday',
                        'notes' => $attendanceData['notes'],
                        'holiday_name' => $attendanceData['holiday_name'],
                        'is_holiday' => true,
                        'created_by' => auth()->id()
                    ]
                );
                $createdRecords->push($record);
            }

            // Log the activity for the holiday
            $this->logAttendanceActivity($holidayRecord, true);

            return response()->json([
                'success' => true,
                'message' => 'Holiday marked for all users',
                'data' => $createdRecords
            ]);
        }

        // Handle regular attendance for a single user
        $attendance = Attendance::updateOrCreate(
            [
                'user_id' => $attendanceData['user_id'],
                'date' => $attendanceData['date']
            ],
            array_filter([
                'status' => $attendanceData['status'],
                'notes' => $attendanceData['notes'],
                'is_holiday' => false,
                'created_by' => auth()->id(),
                'updated_at' => now()
            ])
        );
        
        // Clear any cached attendance data for this user and month
        $date = Carbon::parse($attendanceData['date']);
        $cacheKey = "attendance_stats_{$attendanceData['user_id']}_{$date->month}_{$date->year}";
        \Cache::forget($cacheKey);

        // Log the activity
        $this->logAttendanceActivity($attendance);

        return response()->json([
            'success' => true,
            'message' => 'Attendance recorded successfully',
            'data' => $attendance
        ]);
    }
    
    /**
     * Calculate attendance statistics for a user.
     *
     * @param int $userId
     * @param int|null $month
     * @param int|null $year
     * @return array
     */
    public function calculateAttendanceStats($userId, $month = null, $year = null)
    {
        $currentDate = now();
        $month = $month ?? $currentDate->month;
        $year = $year ?? $currentDate->year;
        $startOfMonth = Carbon::create($year, $month, 1)->startOfMonth();
        $endOfMonth = $startOfMonth->copy()->endOfMonth();
        
        // Get all attendance records for the month
        $attendanceRecords = Attendance::where('user_id', $userId)
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->get();
            
        // Get holidays for the month
        $holidays = Attendance::whereNull('user_id')
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->get()
            ->pluck('date');
            
        // Count present/absent days
        $presentCount = $attendanceRecords->where('status', 'present')->count();
        $absentCount = $attendanceRecords->where('status', 'absent')->count();
        
        // Count working days up to today (excluding weekends and holidays)
        $workingDaysCount = 0;
        $today = min($currentDate, $endOfMonth);
        
        for ($date = $startOfMonth->copy(); $date->lte($today); $date->addDay()) {
            if (!$date->isWeekend() && !$holidays->contains($date->format('Y-m-d'))) {
                $workingDaysCount++;
            }
        }
        
        // Count total working days in the month (excluding weekends and holidays)
        $totalWorkingDays = 0;
        for ($date = $startOfMonth->copy(); $date->lte($endOfMonth); $date->addDay()) {
            if (!$date->isWeekend() && !$holidays->contains($date->format('Y-m-d'))) {
                $totalWorkingDays++;
            }
        }
        
        // Calculate attendance percentage
        $attendancePercentage = 100.0;
        if ($workingDaysCount > 0) {
            $attendancePercentage = max(0, 100 - (($absentCount / $workingDaysCount) * 100));
            $attendancePercentage = round($attendancePercentage, 1);
        }
        
        return [
            'present' => $presentCount,
            'absent' => $absentCount,
            'holidays' => $holidays->count(),
            'working_days_so_far' => $workingDaysCount,
            'total_working_days' => $totalWorkingDays,
            'attendance_percentage' => $attendancePercentage,
        ];
    }
    
    /**
     * Get monthly attendance data for a user.
     *
     * @param int $userId
     * @param int $month
     * @param int $year
     * @return \Illuminate\Support\Collection
     */
    private function getMonthlyAttendance($userId, $month, $year)
    {
        $startDate = Carbon::create($year, $month, 1);
        $endDate = $startDate->copy()->endOfMonth();
        $today = Carbon::today();
        
        // Get user-specific attendance records
        $userAttendance = Attendance::where('user_id', $userId)
            ->whereBetween('date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
            ->get()
            ->keyBy(function($item) {
                return Carbon::parse($item->date)->format('Y-m-d');
            });
            
        // Get global holiday records (where user_id is null)
        $holidays = Attendance::whereNull('user_id')
            ->whereBetween('date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
            ->get()
            ->keyBy(function($item) {
                return Carbon::parse($item->date)->format('Y-m-d');
            });
            
        $result = collect();
        $currentDate = $startDate->copy();
        
        // Loop through each day of the month
        while ($currentDate->lte($endDate)) {
            $dateStr = $currentDate->format('Y-m-d');
            $isPastOrToday = $currentDate->lte($today);
            
            // Check for user-specific record first, then check for holiday
            $record = $userAttendance[$dateStr] ?? null;
            $holiday = $holidays[$dateStr] ?? null;
            
            $result->push([
                'date' => $dateStr,
                'day_name' => $currentDate->shortEnglishDayOfWeek,
                'day_number' => $currentDate->day,
                'status' => $record ? $record->status : ($holiday ? $holiday->status : null),
                'is_weekend' => $currentDate->isWeekend(),
                'is_future' => $currentDate->isFuture(),
                'can_edit' => $isPastOrToday && !$holiday, // Can't edit holidays
                'notes' => $record ? $record->notes : null,
                'holiday_name' => $holiday ? $holiday->holiday_name : null,
                'is_holiday' => (bool)$holiday, // Flag to identify holidays in the frontend
                'holiday_notes' => $holiday ? $holiday->notes : null // Explicitly include holiday notes
            ]);
            
            $currentDate->addDay();
        }
        
        return $result;
    }
    
    /**
     * Get recent attendance records for a user.
     *
     * @param int $userId
     * @return \Illuminate\Support\Collection
     */
    private function getRecentAttendance($userId)
    {
        return Attendance::where('user_id', $userId)
            ->orderBy('date', 'desc')
            ->take(5)
            ->get()
            ->map(function($record) {
                return [
                    'id' => $record->id,
                    'date' => $record->date->format('Y-m-d'),
                    'status' => $record->status,
                    'notes' => $record->notes
                ];
            });
    }
    
    /**
     * Log attendance activity
     * 
     * @param \App\Models\Attendance $attendance
     * @param bool $isHoliday
     * @return void
     */
    private function logAttendanceActivity($attendance, $isHoliday = false)
    {
        $statusText = $attendance->status ?? 'not set';
        $action = $attendance->wasRecentlyCreated ? 'marked' : 'updated';
        $formattedDate = $attendance->date->format('M d, Y');
        $description = $isHoliday 
            ? "Holiday {$action}: " . ($attendance->holiday_name ?? $attendance->notes) . " on {$formattedDate}"
            : "Attendance {$action} as {$statusText} for {$formattedDate}";

        UserActivity::create([
            'user_id' => auth()->id(),
            'activity_type' => $attendance->wasRecentlyCreated 
                ? UserActivity::TYPE_CREATED 
                : UserActivity::TYPE_UPDATED,
            'description' => $description,
            'model_type' => get_class($attendance),
            'model_id' => $attendance->id,
            'old_values' => $attendance->wasRecentlyCreated ? null : $attendance->getOriginal(),
            'new_values' => $attendance->toArray(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);
    }

    /**
     * Get CSS class for status badge
     */
    private function getStatusClass($status)
    {
        $classes = [
            'present' => 'bg-primary',
            'absent' => 'bg-danger',
            'holiday' => 'bg-warning text-dark'
        ];
        
        return $classes[$status] ?? 'bg-light text-dark';
    }
}