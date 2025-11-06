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
        $startOfMonth = now()->startOfMonth();
        
        // Get all attendance records for current month
        $attendanceRecords = Attendance::where('user_id', $user->id)
            ->whereBetween('date', [$startOfMonth, $currentDate])
            ->get();
            
        // Get holidays and present days
        $holidays = $attendanceRecords->where('status', 'holiday')->pluck('date');
        $presentDays = $attendanceRecords->where('status', 'present')->count();
        
        // Calculate working days up to today (excluding weekends and holidays)
        $workingDaysCount = 0;
        
        for ($date = $startOfMonth->copy(); $date->lte($currentDate); $date->addDay()) {
            $dateStr = $date->format('Y-m-d');
            if (!$date->isWeekend() && !$holidays->contains($dateStr)) {
                $workingDaysCount++;
            }
        }
        
        // Calculate attendance percentage
        $attendancePercentage = $workingDaysCount > 0 ? round(($presentDays / $workingDaysCount) * 100, 1) : 0;
        
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
            'present_days' => $presentDays,
            'working_days' => $workingDaysCount,
            'total_days' => $currentDate->daysInMonth,
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
