<?php

namespace App\Http\Controllers\TeacherDashboard;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display attendance overview for a selected date.
     */
    public function index(Request $request)
    {
        $date = $request->get('date', Carbon::today()->format('Y-m-d'));
        $selectedDate = Carbon::parse($date);

        // Get all students
        $students = User::students()->orderBy('name')->get();

        // Get attendance for the selected date
        $attendanceRecords = Attendance::whereDate('date', $selectedDate)
            ->whereHas('user', function ($query) {
                $query->where('role', 'user_student');
            })
            ->get()
            ->keyBy('user_id');

        // Calculate stats
        $presentCount = $attendanceRecords->where('status', 'present')->count();
        $absentCount = $attendanceRecords->where('status', 'absent')->count();
        $notMarked = $students->count() - ($presentCount + $absentCount);

        $stats = [
            'total_students' => $students->count(),
            'present' => $presentCount,
            'absent' => $absentCount,
            'not_marked' => $notMarked,
        ];

        return view('teacher-dashboard.side-pages.attendance', compact(
            'students',
            'attendanceRecords',
            'selectedDate',
            'stats'
        ));
    }

    /**
     * Display bulk attendance form.
     */
    public function create(Request $request)
    {
        $date = $request->get('date', Carbon::today()->format('Y-m-d'));
        $selectedDate = Carbon::parse($date);

        // Get all students
        $students = User::students()->orderBy('name')->get();

        // Get existing attendance for the selected date
        $existingAttendance = Attendance::whereDate('date', $selectedDate)
            ->whereHas('user', function ($query) {
                $query->where('role', 'user_student');
            })
            ->get()
            ->keyBy('user_id');

        return view('teacher-dashboard.side-pages.attendance-take', compact(
            'students',
            'existingAttendance',
            'selectedDate'
        ));
    }

    /**
     * Store bulk attendance.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'attendance' => 'required|array',
            'attendance.*' => 'required|in:present,absent',
            'notes' => 'nullable|array',
            'notes.*' => 'nullable|string|max:255',
        ]);

        $date = Carbon::parse($request->date);

        foreach ($request->attendance as $userId => $status) {
            // Verify the user is a student
            $user = User::find($userId);
            if (!$user || !$user->isStudent()) {
                continue;
            }

            Attendance::updateOrCreate(
                [
                    'user_id' => $userId,
                    'date' => $date->format('Y-m-d'),
                ],
                [
                    'status' => $status,
                    'notes' => $request->notes[$userId] ?? null,
                ]
            );
        }

        return redirect()
            ->route('teacher.attendance.index', ['date' => $date->format('Y-m-d')])
            ->with('success', 'Attendance saved successfully for ' . $date->format('F j, Y'));
    }

    /**
     * Display attendance history by month.
     */
    public function history(Request $request)
    {
        $month = $request->get('month', Carbon::now()->month);
        $year = $request->get('year', Carbon::now()->year);

        // Get all students
        $students = User::students()->orderBy('name')->get();

        // Get attendance for the month
        $attendanceRecords = Attendance::whereMonth('date', $month)
            ->whereYear('date', $year)
            ->whereHas('user', function ($query) {
                $query->where('role', 'user_student');
            })
            ->get();

        // Group by date
        $attendanceByDate = $attendanceRecords->groupBy(function ($record) {
            return $record->date->format('Y-m-d');
        });

        // Get holidays
        $holidays = Attendance::whereNull('user_id')
            ->where('status', 'holiday')
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->get()
            ->pluck('date')
            ->map(fn($d) => $d->format('Y-m-d'))
            ->toArray();

        // Calculate working days in the month
        $startOfMonth = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $endOfMonth = $startOfMonth->copy()->endOfMonth();
        $today = Carbon::today();

        $workingDays = [];
        $date = $startOfMonth->copy();
        while ($date->lte($endOfMonth)) {
            if (!$date->isWeekend() && !in_array($date->format('Y-m-d'), $holidays)) {
                if ($date->lte($today)) {
                    $workingDays[] = $date->format('Y-m-d');
                }
            }
            $date->addDay();
        }

        // Calculate stats per student
        $studentStats = [];
        foreach ($students as $student) {
            $studentAttendance = $attendanceRecords->where('user_id', $student->id);
            $present = $studentAttendance->where('status', 'present')->count();
            $absent = $studentAttendance->where('status', 'absent')->count();
            $total = $present + $absent;
            $percentage = $total > 0 ? round(($present / $total) * 100, 1) : 0;

            $studentStats[$student->id] = [
                'present' => $present,
                'absent' => $absent,
                'total' => $total,
                'percentage' => $percentage,
            ];
        }

        return view('teacher-dashboard.side-pages.attendance-history', compact(
            'students',
            'attendanceByDate',
            'studentStats',
            'workingDays',
            'month',
            'year',
            'holidays'
        ));
    }
}
