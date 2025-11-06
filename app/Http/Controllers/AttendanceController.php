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
        
        // Calculate working days in the month
        $startDate = Carbon::create($year, $month, 1);
        $endDate = $startDate->copy()->endOfMonth();
        $today = now()->startOfDay();
        $todaysDate = $today->format('Y-m-d'); // Initialize $todaysDate
        
        // Count all days in the month as working days
        $workingDays = $startDate->daysInMonth;
        
        // Filter only past or current days with attendance records
        $attendanceUpToToday = $attendanceData->filter(function($day) use ($today) {
            $date = Carbon::parse($day['date']);
            return $date->lte($today);
        });
        
        // Get all working days up to today (excluding weekends and holidays)
        $startDate = Carbon::create($year, $month, 1);
        $endDate = $startDate->copy()->endOfMonth();
        $today = now()->startOfDay();
        
        $holidays = $attendanceUpToToday->where('status', 'holiday')->pluck('date');
        $workingDaysCount = 0;
        
        for ($date = $startDate->copy(); $date->lte($today); $date->addDay()) {
            if (!$date->isWeekend() && !$holidays->contains($date->format('Y-m-d'))) {
                $workingDaysCount++;
            }
        }
        
        // Calculate statistics based on working days
        $presentCount = $attendanceUpToToday->where('status', 'present')->count();
        $absentCount = $attendanceUpToToday->where('status', 'absent')->count();
        $holidayCount = $attendanceUpToToday->where('status', 'holiday')->count();
        
        // Calculate attendance percentage
        $totalWorkingDays = $workingDaysCount > 0 ? $workingDaysCount : 1; // Prevent division by zero
        $totalAbsentDays = $absentCount; // Only count absent days
        
        // Calculate percentage based on present days out of total working days
        $attendancePercentage = $totalWorkingDays > 0 
            ? max(0, min(100, round(($presentCount / $totalWorkingDays) * 100, 1)))
            : 0;
        
        $stats = [
            'present' => $presentCount, 
            'absent' => $absentCount,   
            'holidays' => $holidayCount,
            'total_working_days' => $workingDays,
            'working_days_so_far' => $workingDaysCount,
            'attendance_percentage' => $attendancePercentage,
        ];
        
        // Get recent attendance records
        $recentRecords = $this->getRecentAttendance(Auth::id());
        
        // Prepare months and years for the dropdown
        $months = [
            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
            5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
            9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
        ];
        
        $years = range(now()->year - 2, now()->year + 1);
        
        return view('user-dashboard.side-pages.attendance', [
            'attendanceData' => $attendanceData,
            'stats' => $stats,
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
            'status' => 'nullable|in:present,absent,holiday',
            'notes' => 'nullable|string|max:1000',
            'is_holiday' => 'sometimes|boolean'
        ]);

        $attendanceData = [
            'user_id' => auth()->id(),
            'date' => $validated['date'],
            'notes' => $validated['notes'] ?? null
        ];

        // Handle holiday status
        if (isset($validated['is_holiday']) && $validated['is_holiday']) {
            $attendanceData['status'] = 'holiday';
        } else {
            $attendanceData['status'] = $validated['status'] ?? null;
        }

        // Check if this is an update or create
        $existing = Attendance::where('user_id', $attendanceData['user_id'])
            ->where('date', $attendanceData['date'])
            ->first();
            
        $isUpdate = $existing !== null;
        
        $attendance = Attendance::updateOrCreate(
            [
                'user_id' => $attendanceData['user_id'],
                'date' => $attendanceData['date']
            ],
            array_filter([
                'status' => $attendanceData['status'],
                'notes' => $attendanceData['notes']
            ])
        );
        
        // Log the activity
        $statusText = $attendanceData['status'] ?? 'not set';
        $action = $isUpdate ? 'updated' : 'marked';
        $formattedDate = Carbon::parse($attendanceData['date'])->format('M d, Y');
        $description = "Attendance {$action} as {$statusText} for {$formattedDate}";
        
        // Ensure we have a valid model type
        $modelType = 'App\\Models\\Attendance'; // Use the full namespace
        
        // Log the activity
        UserActivity::create([
            'user_id' => auth()->id(),
            'activity_type' => $isUpdate ? UserActivity::TYPE_UPDATED : UserActivity::TYPE_CREATED,
            'description' => $description,
            'model_type' => $modelType, // Use the full namespace
            'model_id' => $attendance->id,
            'old_values' => $isUpdate ? $existing->toArray() : null,
            'new_values' => $attendance->toArray(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);
        
        // Debug log
        \Log::info('Activity logged', [
            'user_id' => auth()->id(),
            'model_type' => $modelType,
            'model_id' => $attendance->id,
            'description' => $description
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Attendance recorded successfully',
            'data' => $attendance
        ]);
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
        
        // Get existing attendance records for the month
        $attendance = Attendance::where('user_id', $userId)
            ->whereBetween('date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
            ->orderBy('date')
            ->get();
            
        // Transform to the required format
        $result = $attendance->map(function($record) {
            $date = Carbon::parse($record->date);
            $today = Carbon::today();
            $isPastOrToday = $date->lte($today);
            
            return [
                'date' => $record->date->format('Y-m-d'),
                'day_name' => $date->shortEnglishDayOfWeek,
                'day_number' => $date->day,
                'status' => $record->status,
                'is_weekend' => $date->isWeekend(),
                'is_future' => $date->isFuture(),
                'can_edit' => $isPastOrToday,
                'notes' => $record->notes
            ];
        });
        
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
                    'status' => $record->status
                ];
            });
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