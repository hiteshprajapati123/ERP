@extends('layouts.teacher-dashboard')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="h3 mb-1 fw-bold">Welcome back, {{ auth()->user()->name }}!</h1>
            <p class="text-muted mb-0">Here's your teacher dashboard overview</p>
        </div>
        <div class="d-flex align-items-center bg-light rounded-pill px-3 py-2 shadow-sm">
            <i class="far fa-calendar-alt text-primary me-2"></i>
            <span class="fw-medium d-none d-sm-inline">{{ now()->format('l, F j, Y') }}</span>
            <span class="fw-medium d-inline d-sm-none">{{ now()->format('D, M j, y') }}</span>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 g-md-4 mb-4">
        <!-- Total Students -->
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Total Students</p>
                            <h3 class="mb-0 fw-bold">{{ $stats['total_students'] }}</h3>
                        </div>
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                            <i class="fas fa-users text-primary fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Present Today -->
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Present Today</p>
                            <h3 class="mb-0 fw-bold text-success">{{ $stats['present_today'] }}</h3>
                        </div>
                        <div class="bg-success bg-opacity-10 p-3 rounded-circle">
                            <i class="fas fa-user-check text-success fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Absent Today -->
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Absent Today</p>
                            <h3 class="mb-0 fw-bold text-danger">{{ $stats['absent_today'] }}</h3>
                        </div>
                        <div class="bg-danger bg-opacity-10 p-3 rounded-circle">
                            <i class="fas fa-user-times text-danger fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Attendance Percentage -->
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Attendance %</p>
                            <h3 class="mb-0 fw-bold text-info">{{ $stats['attendance_percentage'] }}%</h3>
                        </div>
                        <div class="bg-info bg-opacity-10 p-3 rounded-circle">
                            <i class="fas fa-chart-pie text-info fa-lg"></i>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 6px;">
                        <div class="progress-bar bg-info" role="progressbar"
                             style="width: {{ $stats['attendance_percentage'] }}%"
                             aria-valuenow="{{ $stats['attendance_percentage'] }}"
                             aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions & Not Marked -->
    <div class="row g-3 g-md-4 mb-4">
        <!-- Quick Actions -->
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent border-0 pt-4 pb-0">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-bolt text-warning me-2"></i>Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12 col-md-3">
                            <a href="{{ route('teacher.attendance.create') }}" class="btn btn-outline-primary w-100 py-3">
                                <i class="fas fa-clipboard-check fa-2x mb-2 d-block"></i>
                                <span class="small">Take Attendance</span>
                            </a>
                        </div>
                        <div class="col-12 col-md-3">
                            <a href="{{ route('teacher.students.index') }}" class="btn btn-outline-success w-100 py-3">
                                <i class="fas fa-users fa-2x mb-2 d-block"></i>
                                <span class="small">View Students</span>
                            </a>
                        </div>
                        <div class="col-12 col-md-3">
                            <a href="{{ route('teacher.attendance.history') }}" class="btn btn-outline-info w-100 py-3">
                                <i class="fas fa-history fa-2x mb-2 d-block"></i>
                                <span class="small">Attendance History</span>
                            </a>
                        </div>
                        <div class="col-12 col-md-3">
                            <a href="{{ route('teacher.profile') }}" class="btn btn-outline-secondary w-100 py-3">
                                <i class="fas fa-user-cog fa-2x mb-2 d-block"></i>
                                <span class="small">My Profile</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Not Marked Alert -->
        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow-sm h-100 {{ $stats['not_marked'] > 0 ? 'border-warning' : 'border-success' }}" style="border-left: 4px solid {{ $stats['not_marked'] > 0 ? '#f59e0b' : '#10b981' }} !important;">
                <div class="card-body d-flex flex-column justify-content-center">
                    @if($stats['not_marked'] > 0)
                        <div class="text-center">
                            <div class="bg-warning bg-opacity-10 p-3 rounded-circle d-inline-flex mb-3">
                                <i class="fas fa-exclamation-triangle text-warning fa-2x"></i>
                            </div>
                            <h5 class="fw-bold text-warning">{{ $stats['not_marked'] }} Students</h5>
                            <p class="text-muted small mb-3">attendance not marked for today</p>
                            <a href="{{ route('teacher.attendance.create') }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-clipboard-check me-1"></i> Mark Attendance Now
                            </a>
                        </div>
                    @else
                        <div class="text-center">
                            <div class="bg-success bg-opacity-10 p-3 rounded-circle d-inline-flex mb-3">
                                <i class="fas fa-check-circle text-success fa-2x"></i>
                            </div>
                            <h5 class="fw-bold text-success">All Done!</h5>
                            <p class="text-muted small mb-0">Attendance marked for all students today</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Attendance -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent border-0 pt-4 pb-0 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-clock text-primary me-2"></i>Recent Attendance Records
                    </h5>
                    <a href="{{ route('teacher.attendance.index') }}" class="btn btn-sm btn-outline-primary">
                        View All <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="card-body">
                    @if($recentAttendance->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Student</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Notes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentAttendance as $record)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ $record->user->profile_photo_url }}"
                                                         class="rounded-circle me-2" width="32" height="32"
                                                         style="object-fit: cover;">
                                                    <div>
                                                        <span class="fw-medium">{{ $record->user->name }}</span>
                                                        @if($record->user->roll_number)
                                                            <br><small class="text-muted">{{ $record->user->roll_number }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $record->date->format('M j, Y') }}</td>
                                            <td>
                                                @if($record->status === 'present')
                                                    <span class="badge bg-success">Present</span>
                                                @elseif($record->status === 'absent')
                                                    <span class="badge bg-danger">Absent</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ ucfirst($record->status) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="text-muted small">{{ $record->notes ?? '-' }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No recent attendance records found</p>
                            <a href="{{ route('teacher.attendance.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-1"></i> Take Attendance
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
