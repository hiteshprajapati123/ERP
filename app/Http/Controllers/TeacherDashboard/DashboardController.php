<?php

namespace App\Http\Controllers\TeacherDashboard;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the teacher's dashboard.
     */
    public function index()
    {
        $today = Carbon::today();

        // Get total students
        $totalStudents = User::students()->count();

        // Get today's attendance stats
        $todayAttendance = Attendance::whereDate('date', $today)
            ->whereHas('user', function ($query) {
                $query->where('role', 'user_student');
            })
            ->get();

        $presentToday = $todayAttendance->where('status', 'present')->count();
        $absentToday = $todayAttendance->where('status', 'absent')->count();

        // Calculate attendance percentage for today
        $attendancePercentage = $totalStudents > 0
            ? round(($presentToday / $totalStudents) * 100, 1)
            : 0;

        // Get recent attendance records (last 7 days)
        $recentAttendance = Attendance::with('user')
            ->whereHas('user', function ($query) {
                $query->where('role', 'user_student');
            })
            ->where('date', '>=', Carbon::today()->subDays(7))
            ->orderBy('date', 'desc')
            ->limit(10)
            ->get();

        $stats = [
            'total_students' => $totalStudents,
            'present_today' => $presentToday,
            'absent_today' => $absentToday,
            'attendance_percentage' => $attendancePercentage,
            'not_marked' => $totalStudents - ($presentToday + $absentToday),
        ];

        return view('teacher-dashboard.dashboard', compact('stats', 'recentAttendance'));
    }
}
