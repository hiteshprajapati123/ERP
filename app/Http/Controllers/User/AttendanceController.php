<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    /**
     * Get monthly attendance data for the calendar and statistics
     */
    public function monthlyData(Request $request)
    {
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);
        
        $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $endDate = $startDate->copy()->endOfMonth();
        
        // Get all attendance records for the month
        $attendance = Attendance::where('user_id', Auth::id())
            ->whereBetween('date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
            ->get()
            ->keyBy(function($item) {
                return Carbon::parse($item->date)->format('Y-m-d');
            });
        
        // Calculate statistics
        $stats = [
            'present' => $attendance->where('status', 'present')->count(),
            'on_leave' => $attendance->where('status', 'leave')->count(),
            'late' => $attendance->where('status', 'late')->count(),
            'half_day' => $attendance->where('status', 'half_day')->count(),
            'absent' => $attendance->where('status', 'absent')->count(),
        ];
        
        // Format attendance data for calendar
        $attendanceData = [];
        $currentDate = $startDate->copy();
        
        while ($currentDate <= $endDate) {
            $dateString = $currentDate->format('Y-m-d');
            $record = $attendance->get($dateString);
            
            if ($record) {
                $attendanceData[$dateString] = [
                    'status' => $record->status,
                    'check_in' => $record->check_in,
                    'check_out' => $record->check_out,
                    'working_hours' => $record->working_hours,
                ];
            } else {
                $attendanceData[$dateString] = [
                    'status' => $currentDate->isWeekend() ? 'weekend' : 'absent',
                    'check_in' => null,
                    'check_out' => null,
                    'working_hours' => 0,
                ];
            }
            
            $currentDate->addDay();
        }
        
        return response()->json([
            'success' => true,
            'stats' => $stats,
            'attendance_data' => $attendanceData,
            'records' => $attendance->sortByDesc('date')->values()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
