<?php

namespace App\Http\Controllers\UserDashboard;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\ExamResult;
use App\Models\Fee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the user's dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        $currentDate = now();
        
        // Get attendance statistics using AttendanceController
        $attendanceController = new \App\Http\Controllers\AttendanceController();
        $attendanceStats = $attendanceController->calculateAttendanceStats(
            $user->id,
            $currentDate->month,
            $currentDate->year
        );
        
        // Extract the stats
        $presentCount = $attendanceStats['present'];
        $absentCount = $attendanceStats['absent'];
        $workingDaysCount = $attendanceStats['working_days_so_far'];
        $totalWorkingDays = $attendanceStats['total_working_days'];
        $attendancePercentage = $attendanceStats['attendance_percentage'];
        
        // Prepare data for the view
        // Get fees data matching fees page implementation
        $fees = $user->fees()
            ->orderBy('due_date', 'desc')
            ->get();

        // Calculate fee summaries
        $totalFees = $fees->sum('amount');
        $paidFees = $fees->where('status', 'paid')->sum('amount');
        
        // Get pending fees (only those with status 'pending')
        $pendingFees = $fees->where('status', 'pending');
        $pendingAmount = $pendingFees->sum('amount');
        $pendingCount = $pendingFees->count();
        
        $balance = $totalFees - $paidFees;
        
        // Get the most recently inserted exam result
        $latestExam = ExamResult::where('user_id', $user->id)
            ->latest()  // Orders by created_at in descending order
            ->first();
            
        // If still no result, try to get any exam result as fallback
        if (!$latestExam) {
            $latestExam = ExamResult::where('user_id', $user->id)
                ->first();
        }
            
        $stats = [
            'attendance_percentage' => $attendancePercentage,
            'present_days' => $presentCount,
            'absent_days' => $absentCount,
            'working_days' => $workingDaysCount,
            'total_working_days' => $totalWorkingDays,
            'pending_fees' => $pendingAmount, // Only pending fees with status 'pending'
            'pending_count' => $pendingCount, // Number of pending installments
            'total_fees' => $totalFees,
            'paid_fees' => $paidFees,
            'all_fees' => $fees, // Pass all fees for reference
            'latest_exam' => $latestExam
        ];
        
        return view('user-dashboard.dashboard', compact('stats'));
    }
}
