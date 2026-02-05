@extends('layouts.teacher-dashboard')

@section('title', $user->name . ' - Student Details')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="h3 mb-1 fw-bold">Student Details</h1>
            <p class="text-muted mb-0">View student information and attendance</p>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('teacher.students.index') }}">Students</a></li>
                <li class="breadcrumb-item active">{{ $user->name }}</li>
            </ol>
        </nav>
    </div>

    <div class="row g-4">
        <!-- Student Profile Card -->
        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-5">
                    <img src="{{ $user->profile_photo_url }}"
                         class="rounded-circle shadow mb-4"
                         width="120" height="120"
                         style="object-fit: cover;">

                    <h4 class="fw-bold mb-1">{{ $user->name }}</h4>
                    @if($user->roll_number)
                        <p class="text-muted mb-3">
                            <span class="badge bg-secondary bg-opacity-10 text-secondary">
                                Roll No: {{ $user->roll_number }}
                            </span>
                        </p>
                    @endif

                    <div class="d-flex justify-content-center gap-2 mb-3">
                        <span class="badge bg-primary bg-opacity-10 text-primary">Student</span>
                        @if($user->gender)
                            <span class="badge {{ $user->gender === 'male' ? 'bg-info' : 'bg-pink' }} bg-opacity-10 {{ $user->gender === 'male' ? 'text-info' : 'text-pink' }}">
                                {{ ucfirst($user->gender) }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-header bg-transparent border-0 pt-4 pb-0">
                    <h6 class="fw-bold mb-0">
                        <i class="fas fa-address-book text-primary me-2"></i>Contact Information
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                            <i class="fas fa-envelope text-primary"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Email</small>
                            <span class="fw-medium small">{{ $user->email }}</span>
                        </div>
                    </div>
                    @if($user->phone)
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-success bg-opacity-10 p-2 rounded me-3">
                                <i class="fas fa-phone text-success"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Phone</small>
                                <span class="fw-medium small">{{ $user->phone }}</span>
                            </div>
                        </div>
                    @endif
                    @if($user->address)
                        <div class="d-flex align-items-start">
                            <div class="bg-warning bg-opacity-10 p-2 rounded me-3">
                                <i class="fas fa-map-marker-alt text-warning"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Address</small>
                                <span class="fw-medium small">
                                    {{ $user->address }}
                                    @if($user->city || $user->state)
                                        <br>{{ $user->city }}{{ $user->city && $user->state ? ', ' : '' }}{{ $user->state }} {{ $user->pincode }}
                                    @endif
                                </span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Parent Info -->
            @if($user->father_name || $user->mother_name)
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-header bg-transparent border-0 pt-4 pb-0">
                        <h6 class="fw-bold mb-0">
                            <i class="fas fa-users text-primary me-2"></i>Parent Information
                        </h6>
                    </div>
                    <div class="card-body">
                        @if($user->father_name)
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-info bg-opacity-10 p-2 rounded me-3">
                                    <i class="fas fa-male text-info"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Father's Name</small>
                                    <span class="fw-medium small">{{ $user->father_name }}</span>
                                </div>
                            </div>
                        @endif
                        @if($user->mother_name)
                            <div class="d-flex align-items-center">
                                <div class="bg-pink bg-opacity-10 p-2 rounded me-3">
                                    <i class="fas fa-female text-pink"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Mother's Name</small>
                                    <span class="fw-medium small">{{ $user->mother_name }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <!-- Attendance Section -->
        <div class="col-12 col-lg-8">
            <!-- Attendance Stats -->
            <div class="row g-3 mb-4">
                <div class="col-12 col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <div class="bg-success bg-opacity-10 p-2 rounded-circle d-inline-flex mb-2">
                                <i class="fas fa-check text-success"></i>
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
                                <i class="fas fa-times text-danger"></i>
                            </div>
                            <h4 class="fw-bold text-danger mb-0">{{ $stats['absent'] }}</h4>
                            <small class="text-muted">Absent</small>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <div class="bg-secondary bg-opacity-10 p-2 rounded-circle d-inline-flex mb-2">
                                <i class="fas fa-calendar-day text-secondary"></i>
                            </div>
                            <h4 class="fw-bold mb-0">{{ $stats['total_days'] }}</h4>
                            <small class="text-muted">Total Days</small>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <div class="bg-info bg-opacity-10 p-2 rounded-circle d-inline-flex mb-2">
                                <i class="fas fa-percentage text-info"></i>
                            </div>
                            <h4 class="fw-bold text-info mb-0">{{ $stats['attendance_percentage'] }}%</h4>
                            <small class="text-muted">Attendance</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Attendance Records -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent border-0 pt-4 pb-0 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">
                        <i class="fas fa-calendar-check text-primary me-2"></i>
                        Attendance Records ({{ now()->format('F Y') }})
                    </h5>
                </div>
                <div class="card-body">
                    @if($attendanceRecords->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Date</th>
                                        <th>Day</th>
                                        <th>Status</th>
                                        <th>Notes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($attendanceRecords as $record)
                                        <tr>
                                            <td>
                                                <span class="fw-medium">{{ $record->date->format('M j, Y') }}</span>
                                            </td>
                                            <td>
                                                <span class="text-muted">{{ $record->date->format('l') }}</span>
                                            </td>
                                            <td>
                                                @if($record->status === 'present')
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-check me-1"></i> Present
                                                    </span>
                                                @elseif($record->status === 'absent')
                                                    <span class="badge bg-danger">
                                                        <i class="fas fa-times me-1"></i> Absent
                                                    </span>
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
                            <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No attendance records found</h5>
                            <p class="text-muted small">No attendance has been marked for this student this month</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Back Button -->
    <div class="mt-4">
        <a href="{{ route('teacher.students.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back to Students
        </a>
    </div>
</div>

<style>
    .bg-pink { background-color: rgba(236, 72, 153, 0.1); }
    .text-pink { color: #ec4899; }
</style>
@endsection
