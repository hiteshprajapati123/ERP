@extends('layouts.teacher-dashboard')

@section('title', 'Take Attendance')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="h3 mb-1 fw-bold">Take Attendance</h1>
            <p class="text-muted mb-0">Mark attendance for {{ $selectedDate->format('F j, Y') }}</p>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('teacher.attendance.index') }}">Attendance</a></li>
                <li class="breadcrumb-item active">Take Attendance</li>
            </ol>
        </nav>
    </div>

    <!-- Date Selector -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <div class="row g-3 align-items-end">
                <div class="col-12 col-md-4">
                    <label class="form-label text-muted small">Select Date</label>
                    <form action="{{ route('teacher.attendance.create') }}" method="GET" id="dateForm">
                        <input type="date" name="date" class="form-control"
                               value="{{ $selectedDate->format('Y-m-d') }}"
                               max="{{ now()->format('Y-m-d') }}"
                               onchange="document.getElementById('dateForm').submit();">
                    </form>
                </div>
                <div class="col-12 col-md-8">
                    <div class="d-flex flex-wrap gap-2 justify-content-md-end">
                        <button type="button" class="btn btn-outline-success flex-fill flex-md-grow-0" onclick="markAll('present')">
                            <i class="fas fa-check-double me-1"></i> Mark All Present
                        </button>
                        <button type="button" class="btn btn-outline-danger flex-fill flex-md-grow-0" onclick="markAll('absent')">
                            <i class="fas fa-times me-1"></i> Mark All Absent
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Attendance Form -->
    <form action="{{ route('teacher.attendance.store') }}" method="POST">
        @csrf
        <input type="hidden" name="date" value="{{ $selectedDate->format('Y-m-d') }}">

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent border-0 pt-4 pb-0 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0">
                    <i class="fas fa-clipboard-list text-primary me-2"></i>
                    Student Attendance - {{ $selectedDate->format('l, F j, Y') }}
                </h5>
                <span class="badge bg-primary bg-opacity-10 text-primary">
                    {{ $students->count() }} Students
                </span>
            </div>
            <div class="card-body">
                @if($students->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 50px;">#</th>
                                    <th>Student</th>
                                    <th>Roll Number</th>
                                    <th style="width: 200px;">Status</th>
                                    <th style="width: 250px;">Notes (Optional)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $index => $student)
                                    @php
                                        $existing = $existingAttendance->get($student->id);
                                    @endphp
                                    <tr>
                                        <td class="text-muted">{{ $index + 1 }}</td>
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
                                            <div class="btn-group w-100" role="group">
                                                <input type="radio"
                                                       class="btn-check attendance-radio"
                                                       name="attendance[{{ $student->id }}]"
                                                       id="present_{{ $student->id }}"
                                                       value="present"
                                                       {{ $existing && $existing->status === 'present' ? 'checked' : '' }}
                                                       required>
                                                <label class="btn btn-outline-success btn-sm" for="present_{{ $student->id }}">
                                                    <i class="fas fa-check me-1"></i> Present
                                                </label>

                                                <input type="radio"
                                                       class="btn-check attendance-radio"
                                                       name="attendance[{{ $student->id }}]"
                                                       id="absent_{{ $student->id }}"
                                                       value="absent"
                                                       {{ $existing && $existing->status === 'absent' ? 'checked' : '' }}>
                                                <label class="btn btn-outline-danger btn-sm" for="absent_{{ $student->id }}">
                                                    <i class="fas fa-times me-1"></i> Absent
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text"
                                                   name="notes[{{ $student->id }}]"
                                                   class="form-control form-control-sm"
                                                   placeholder="Optional notes..."
                                                   value="{{ $existing?->notes ?? '' }}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4 pt-3 border-top gap-2">
                        <a href="{{ route('teacher.attendance.index', ['date' => $selectedDate->format('Y-m-d')]) }}"
                           class="btn btn-outline-secondary w-100 w-md-auto">
                            <i class="fas fa-arrow-left me-1"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary w-100 w-md-auto">
                            <i class="fas fa-save me-1"></i> Save Attendance
                        </button>
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
    </form>
</div>

@push('scripts')
<script>
    function markAll(status) {
        const radios = document.querySelectorAll(`input[value="${status}"].attendance-radio`);
        radios.forEach(radio => {
            radio.checked = true;
        });
    }
</script>
@endpush
@endsection
