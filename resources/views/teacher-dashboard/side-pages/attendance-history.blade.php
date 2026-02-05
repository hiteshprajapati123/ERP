@extends('layouts.teacher-dashboard')

@section('title', 'Attendance History')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="h3 mb-1 fw-bold">Attendance History</h1>
            <p class="text-muted mb-0">View attendance history for {{ \Carbon\Carbon::create($year, $month, 1)->format('F Y') }}</p>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('teacher.attendance.index') }}">Attendance</a></li>
                <li class="breadcrumb-item active">History</li>
            </ol>
        </nav>
    </div>

    <!-- Month/Year Selector -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('teacher.attendance.history') }}" method="GET">
                <div class="row g-3 align-items-end">
                    <div class="col-6 col-md-3">
                        <label class="form-label text-muted small">Month</label>
                        <select name="month" class="form-select">
                            @for($m = 1; $m <= 12; $m++)
                                <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-6 col-md-3">
                        <label class="form-label text-muted small">Year</label>
                        <select name="year" class="form-select">
                            @for($y = date('Y'); $y >= date('Y') - 5; $y--)
                                <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-12 col-md-3">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-filter me-1"></i> Apply Filter
                        </button>
                    </div>
                    <div class="col-12 col-md-3">
                        <a href="{{ route('teacher.attendance.index') }}" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-arrow-left me-1"></i> Back to Today
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Summary Stats -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-transparent border-0 pt-4 pb-0">
            <h5 class="fw-bold mb-0">
                <i class="fas fa-chart-bar text-primary me-2"></i>
                Monthly Summary
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Student</th>
                            <th>Roll Number</th>
                            <th class="text-center">Present</th>
                            <th class="text-center">Absent</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Attendance %</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $index => $student)
                            @php
                                $stats = $studentStats[$student->id] ?? ['present' => 0, 'absent' => 0, 'total' => 0, 'percentage' => 0];
                            @endphp
                            <tr>
                                <td class="text-muted">{{ $index + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $student->profile_photo_url }}"
                                             class="rounded-circle me-2" width="36" height="36"
                                             style="object-fit: cover;">
                                        <div>
                                            <a href="{{ route('teacher.students.show', $student) }}" class="fw-medium text-decoration-none">
                                                {{ $student->name }}
                                            </a>
                                            <br>
                                            <small class="text-muted">{{ $student->email }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($student->roll_number)
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary">
                                            {{ $student->roll_number }}
                                        </span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success bg-opacity-10 text-success">
                                        {{ $stats['present'] }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-danger bg-opacity-10 text-danger">
                                        {{ $stats['absent'] }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="fw-medium">{{ $stats['total'] }}</span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="progress flex-grow-1 me-2" style="height: 8px; max-width: 100px;">
                                            <div class="progress-bar {{ $stats['percentage'] >= 75 ? 'bg-success' : ($stats['percentage'] >= 50 ? 'bg-warning' : 'bg-danger') }}"
                                                 role="progressbar"
                                                 style="width: {{ $stats['percentage'] }}%"></div>
                                        </div>
                                        <span class="fw-bold {{ $stats['percentage'] >= 75 ? 'text-success' : ($stats['percentage'] >= 50 ? 'text-warning' : 'text-danger') }}">
                                            {{ $stats['percentage'] }}%
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Calendar View -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-transparent border-0 pt-4 pb-0">
            <h5 class="fw-bold mb-0">
                <i class="fas fa-calendar-alt text-primary me-2"></i>
                Daily Attendance Overview
            </h5>
        </div>
        <div class="card-body">
            @if(count($workingDays) > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead class="table-light">
                            <tr>
                                <th>Student</th>
                                @foreach($workingDays as $date)
                                    <th class="text-center" style="min-width: 50px;">
                                        <small class="d-block text-muted">{{ \Carbon\Carbon::parse($date)->format('D') }}</small>
                                        <span>{{ \Carbon\Carbon::parse($date)->format('j') }}</span>
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                                <tr>
                                    <td>
                                        <small class="fw-medium">{{ Str::limit($student->name, 15) }}</small>
                                    </td>
                                    @foreach($workingDays as $date)
                                        @php
                                            $dayAttendance = $attendanceByDate->get($date)?->firstWhere('user_id', $student->id);
                                        @endphp
                                        <td class="text-center p-1">
                                            @if($dayAttendance)
                                                @if($dayAttendance->status === 'present')
                                                    <span class="badge bg-success rounded-circle p-1" title="Present">
                                                        <i class="fas fa-check fa-xs"></i>
                                                    </span>
                                                @elseif($dayAttendance->status === 'absent')
                                                    <span class="badge bg-danger rounded-circle p-1" title="Absent">
                                                        <i class="fas fa-times fa-xs"></i>
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary rounded-circle p-1">-</span>
                                                @endif
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Legend -->
                <div class="mt-3 d-flex flex-wrap gap-3 justify-content-center">
                    <span class="d-flex align-items-center">
                        <span class="badge bg-success rounded-circle p-1 me-1">
                            <i class="fas fa-check fa-xs"></i>
                        </span>
                        <small class="text-muted">Present</small>
                    </span>
                    <span class="d-flex align-items-center">
                        <span class="badge bg-danger rounded-circle p-1 me-1">
                            <i class="fas fa-times fa-xs"></i>
                        </span>
                        <small class="text-muted">Absent</small>
                    </span>
                    <span class="d-flex align-items-center">
                        <span class="text-muted me-1">-</span>
                        <small class="text-muted">Not Marked</small>
                    </span>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No working days recorded</h5>
                    <p class="text-muted">No attendance data available for this month</p>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .sticky-col {
        position: sticky;
        left: 0;
        background: white;
        z-index: 1;
        min-width: 150px;
        max-width: 150px;
    }

    thead .sticky-col {
        z-index: 2;
    }

    .table-bordered {
        border-collapse: separate;
        border-spacing: 0;
    }
</style>
@endsection
