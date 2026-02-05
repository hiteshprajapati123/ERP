@extends('layouts.teacher-dashboard')

@section('title', 'Students')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="h3 mb-1 fw-bold">Students</h1>
            <p class="text-muted mb-0">View and manage student information</p>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Students</li>
            </ol>
        </nav>
    </div>

    <!-- Search & Filter -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('teacher.students.index') }}" method="GET">
                <div class="row g-3 align-items-end">
                    <div class="col-12 col-md-8 col-lg-6">
                        <label class="form-label text-muted small">Search Students</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" name="search" class="form-control border-start-0"
                                   placeholder="Search by name, email, roll number, or phone..."
                                   value="{{ $search ?? '' }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-3">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search me-1"></i> Search
                        </button>
                    </div>
                    @if($search)
                        <div class="col-12 col-lg-3">
                            <a href="{{ route('teacher.students.index') }}" class="btn btn-outline-secondary w-100">
                                <i class="fas fa-times me-1"></i> Clear Search
                            </a>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Students List -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-transparent border-0 pt-4 pb-0 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0">
                <i class="fas fa-users text-primary me-2"></i>
                Student List
                <span class="badge bg-primary bg-opacity-10 text-primary ms-2">{{ $students->total() }}</span>
            </h5>
        </div>
        <div class="card-body">
            @if($students->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Student</th>
                                <th>Roll Number</th>
                                <th>Contact</th>
                                <th>Gender</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $student->profile_photo_url }}"
                                                 class="rounded-circle me-3" width="40" height="40"
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
                                        @if($student->phone)
                                            <span class="small">{{ $student->phone }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($student->gender)
                                            <span class="badge {{ $student->gender === 'male' ? 'bg-info' : 'bg-pink' }} bg-opacity-10 {{ $student->gender === 'male' ? 'text-info' : 'text-pink' }}">
                                                {{ ucfirst($student->gender) }}
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('teacher.students.show', $student) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye me-1"></i> View Details
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $students->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-users-slash fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No students found</h5>
                    @if($search)
                        <p class="text-muted">Try adjusting your search criteria</p>
                        <a href="{{ route('teacher.students.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-times me-1"></i> Clear Search
                        </a>
                    @else
                        <p class="text-muted">No students have been added yet</p>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .bg-pink { background-color: #ec4899; }
    .text-pink { color: #ec4899; }
</style>
@endsection
