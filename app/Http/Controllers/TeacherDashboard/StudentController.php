<?php

namespace App\Http\Controllers\TeacherDashboard;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a list of all students.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $students = User::students()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('roll_number', 'like', "%{$search}%")
                      ->orWhere('phone', 'like', "%{$search}%");
                });
            })
            ->orderBy('name')
            ->paginate(15);

        return view('teacher-dashboard.side-pages.students', compact('students', 'search'));
    }

    /**
     * Display individual student details with attendance.
     */
    public function show(User $user)
    {
        // Ensure we're viewing a student
        if (!$user->isStudent()) {
            abort(404);
        }

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Get attendance records for the student
        $attendanceRecords = Attendance::where('user_id', $user->id)
            ->whereMonth('date', $currentMonth)
            ->whereYear('date', $currentYear)
            ->orderBy('date', 'desc')
            ->get();

        // Calculate stats
        $presentCount = $attendanceRecords->where('status', 'present')->count();
        $absentCount = $attendanceRecords->where('status', 'absent')->count();
        $totalDays = $presentCount + $absentCount;
        $attendancePercentage = $totalDays > 0
            ? round(($presentCount / $totalDays) * 100, 1)
            : 0;

        $stats = [
            'present' => $presentCount,
            'absent' => $absentCount,
            'total_days' => $totalDays,
            'attendance_percentage' => $attendancePercentage,
        ];

        return view('teacher-dashboard.side-pages.student-detail', compact('user', 'attendanceRecords', 'stats'));
    }
}
