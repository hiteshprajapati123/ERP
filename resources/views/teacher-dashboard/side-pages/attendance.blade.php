@extends('layouts.teacher-dashboard')

@section('title', 'Attendance Overview')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="h3 mb-1 fw-bold">Attendance Overview</h1>
            <p class="text-muted mb-0">View attendance for {{ $selectedDate->format('F j, Y') }}</p>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Attendance</li>
            </ol>
        </nav>
    </div>

    <!-- Date Selector & Actions -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <div class="row g-3 align-items-end">
                <div class="col-12 col-md-4">
                    <label class="form-label text-muted small">Select Date</label>
                    <form action="{{ route('teacher.attendance.index') }}" method="GET" id="dateForm">
                        <input type="date" name="date" class="form-control"
                               value="{{ $selectedDate->format('Y-m-d') }}"
                               max="{{ now()->format('Y-m-d') }}"
                               onchange="document.getElementById('dateForm').submit();">
                    </form>
                </div>
                <div class="col-12 col-md-8">
                    <div class="d-flex flex-wrap gap-2 justify-content-md-end">
                        <a href="{{ route('teacher.attendance.create', ['date' => $selectedDate->format('Y-m-d')]) }}"
                           class="btn btn-primary flex-fill flex-md-grow-0">
                            <i class="fas fa-clipboard-check me-1"></i> Take/Edit Attendance
                        </a>
                        <a href="{{ route('teacher.attendance.history') }}" class="btn btn-outline-info flex-fill flex-md-grow-0">
                            <i class="fas fa-history me-1"></i> View History
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="bg-primary bg-opacity-10 p-2 rounded-circle d-inline-flex mb-2">
                        <i class="fas fa-users text-primary"></i>
                    </div>
                    <h4 class="fw-bold mb-0">{{ $stats['total_students'] }}</h4>
                    <small class="text-muted">Total Students</small>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="bg-success bg-opacity-10 p-2 rounded-circle d-inline-flex mb-2">
                        <i class="fas fa-user-check text-success"></i>
                    </div>
                    <h4 class="fw-bold text-success mb-0">{{ $stats['present'] }}</h4>
                    <small class="text-muted">Present</small>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="bg-danger bg-opacity-10 p-2 rounded-circle d-inline-flex mb-2">
                        <i class="fas fa-user-times text-danger"></i>
                    </div>
                    <h4 class="fw-bold text-danger mb-0">{{ $stats['absent'] }}</h4>
                    <small class="text-muted">Absent</small>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="bg-warning bg-opacity-10 p-2 rounded-circle d-inline-flex mb-2">
                        <i class="fas fa-question text-warning"></i>
                    </div>
                    <h4 class="fw-bold text-warning mb-0">{{ $stats['not_marked'] }}</h4>
                    <small class="text-muted">Not Marked</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Attendance List -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-transparent border-0 pt-4 pb-0 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0">
                <i class="fas fa-list text-primary me-2"></i>
                Attendance for {{ $selectedDate->format('l, F j, Y') }}
            </h5>
        </div>
        <div class="card-body">
            @if($students->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Student</th>
                                <th>Roll Number</th>
                                <th>Status</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $index => $student)
                                @php
                                    $attendance = $attendanceRecords->get($student->id);
                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $student->profile_photo_url }}"
                                                 class="rounded-circle me-2" width="36" height="36"
                                                 style="object-fit: cover;">
                                            <div>
                                                <span class="fw-medium">{{ $student->name }}</span>
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
                                    <td>
                                        @if($attendance)
                                            @if($attendance->status === 'present')
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check me-1"></i> Present
                                                </span>
                                            @elseif($attendance->status === 'absent')
                                                <span class="badge bg-danger">
                                                    <i class="fas fa-times me-1"></i> Absent
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">{{ ucfirst($attendance->status) }}</span>
                                            @endif
                                        @else
                                            <span class="badge bg-warning bg-opacity-10 text-warning">
                                                <i class="fas fa-minus me-1"></i> Not Marked
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="text-muted small">
                                            {{ $attendance?->notes ?? '-' }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-users-slash fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No students found</h5>
                    <p class="text-muted">No students have been added to the system yet</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
