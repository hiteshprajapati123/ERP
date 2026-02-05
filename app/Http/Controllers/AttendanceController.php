<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Display the attendance dashboard for the authenticated user.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $currentMonth = $request->get('month', now()->month);
        $currentYear = $request->get('year', now()->year);

        // Get user's attendance records
        $userAttendance = Attendance::where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->get();

        // Get holidays (records with null user_id and status = 'holiday')
        $holidays = Attendance::whereNull('user_id')
            ->where('status', 'holiday')
            ->get();

        // Calculate statistics
        $stats = $this->calculateStats($userAttendance);

        // Prepare attendance data for calendar
        $attendanceData = $this->prepareCalendarData($userAttendance, $holidays);

        return view('user-dashboard.side-pages.attendance', compact(
            'stats',
            'attendanceData',
            'currentMonth',
            'currentYear'
        ));
    }

    /**
     * Calculate attendance statistics.
     */
    private function calculateStats($attendanceRecords): array
    {
        $present = $attendanceRecords->where('status', 'present')->count();
        $absent = $attendanceRecords->where('status', 'absent')->count();

        $totalWorkingDays = $present + $absent;
        $attendancePercentage = $totalWorkingDays > 0
            ? round(($present / $totalWorkingDays) * 100, 1)
            : 0;

        return [
            'present' => $present,
            'absent' => $absent,
            'total_working_days' => $totalWorkingDays,
            'attendance_percentage' => $attendancePercentage,
        ];
    }

    /**
     * Prepare attendance data for the calendar view.
     */
    private function prepareCalendarData($userAttendance, $holidays)
    {
        $calendarData = collect();

        // Add user attendance records
        foreach ($userAttendance as $record) {
            $calendarData->push([
                'date' => $record->date->format('Y-m-d'),
                'status' => $record->status,
                'notes' => $record->notes,
            ]);
        }

        // Add holidays
        foreach ($holidays as $holiday) {
            $calendarData->push([
                'date' => $holiday->date->format('Y-m-d'),
                'status' => 'holiday',
                'notes' => $holiday->notes,
            ]);
        }

        return $calendarData->sortByDesc('date')->values();
    }

    /**
     * Calculate attendance statistics for a specific user and month.
     * Used by DashboardController for the main dashboard.
     */
    public function calculateAttendanceStats(int $userId, int $month, int $year): array
    {
        // Get attendance records for the specified month
        $attendanceRecords = Attendance::where('user_id', $userId)
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->get();

        // Get holidays for the specified month
        $holidays = Attendance::whereNull('user_id')
            ->where('status', 'holiday')
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->get();

        // Count present and absent days
        $present = $attendanceRecords->where('status', 'present')->count();
        $absent = $attendanceRecords->where('status', 'absent')->count();

        // Calculate working days in the month (excluding weekends and holidays)
        $startOfMonth = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $endOfMonth = $startOfMonth->copy()->endOfMonth();
        $today = Carbon::today();

        // If we're in the current month, only count up to today
        $endDate = $today->lt($endOfMonth) ? $today : $endOfMonth;

        $totalWorkingDays = 0;
        $workingDaysSoFar = 0;
        $holidayDates = $holidays->pluck('date')->map(fn($d) => $d->format('Y-m-d'))->toArray();

        // Count all working days in the month
        $date = $startOfMonth->copy();
        while ($date->lte($endOfMonth)) {
            // Skip weekends (Saturday = 6, Sunday = 0)
            if (!$date->isWeekend() && !in_array($date->format('Y-m-d'), $holidayDates)) {
                $totalWorkingDays++;
                if ($date->lte($endDate)) {
                    $workingDaysSoFar++;
                }
            }
            $date->addDay();
        }

        // Calculate attendance percentage
        $attendancePercentage = $workingDaysSoFar > 0
            ? round(($present / $workingDaysSoFar) * 100, 1)
            : 0;

        return [
            'present' => $present,
            'absent' => $absent,
            'working_days_so_far' => $workingDaysSoFar,
            'total_working_days' => $totalWorkingDays,
            'attendance_percentage' => $attendancePercentage,
        ];
    }
}
