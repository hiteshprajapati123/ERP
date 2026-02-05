@extends('layouts.teacher-dashboard')

@section('title', 'Profile')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="h3 mb-1 fw-bold">My Profile</h1>
            <p class="text-muted mb-0">View your profile information</p>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div>

    <div class="row g-4">
        <!-- Profile Photo Card -->
        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-5">
                    <div class="position-relative d-inline-block mb-4">
                        <img src="{{ $user->profile_photo_url }}"
                             class="rounded-circle shadow"
                             width="150" height="150"
                             style="object-fit: cover;"
                             id="profilePhotoPreview">
                        <button type="button" class="btn btn-primary btn-sm position-absolute bottom-0 end-0 rounded-circle"
                                style="width: 40px; height: 40px;"
                                onclick="document.getElementById('photoInput').click()">
                            <i class="fas fa-camera"></i>
                        </button>
                    </div>

                    <h4 class="fw-bold mb-1">{{ $user->name }}</h4>
                    <p class="text-muted mb-3">
                        <span class="badge bg-primary bg-opacity-10 text-primary">Teacher</span>
                    </p>

                    <!-- Photo Upload Form -->
                    <form action="{{ route('teacher.profile.photo') }}" method="POST" enctype="multipart/form-data" id="photoForm">
                        @csrf
                        <input type="file" name="photo" id="photoInput" accept="image/*" class="d-none"
                               onchange="previewPhoto(this); document.getElementById('photoForm').submit();">
                    </form>

                    @error('photo')
                        <div class="alert alert-danger mt-3 small">{{ $message }}</div>
                    @enderror

                    <p class="text-muted small mt-3 mb-0">
                        <i class="fas fa-info-circle me-1"></i>
                        Click the camera icon to update your photo
                    </p>
                </div>
            </div>

            <!-- Contact Info Card -->
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
                            <span class="fw-medium">{{ $user->email }}</span>
                        </div>
                    </div>
                    @if($user->phone)
                        <div class="d-flex align-items-center">
                            <div class="bg-success bg-opacity-10 p-2 rounded me-3">
                                <i class="fas fa-phone text-success"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Phone</small>
                                <span class="fw-medium">{{ $user->phone }}</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Profile Details Card -->
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent border-0 pt-4 pb-0">
                    <h5 class="fw-bold mb-0">
                        <i class="fas fa-user text-primary me-2"></i>Personal Information
                    </h5>
                    <p class="text-muted small mb-0 mt-1">Your profile details (read-only)</p>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <!-- Full Name -->
                        <div class="col-12 col-md-6">
                            <label class="form-label text-muted small">Full Name</label>
                            <div class="form-control bg-light border-0">{{ $user->name }}</div>
                        </div>

                        <!-- Email -->
                        <div class="col-12 col-md-6">
                            <label class="form-label text-muted small">Email Address</label>
                            <div class="form-control bg-light border-0">{{ $user->email }}</div>
                        </div>

                        <!-- Phone -->
                        <div class="col-12 col-md-6">
                            <label class="form-label text-muted small">Phone Number</label>
                            <div class="form-control bg-light border-0">{{ $user->phone ?? 'Not provided' }}</div>
                        </div>

                        <!-- Role -->
                        <div class="col-12 col-md-6">
                            <label class="form-label text-muted small">Role</label>
                            <div class="form-control bg-light border-0">
                                <span class="badge bg-primary">{{ $user->role_name }}</span>
                            </div>
                        </div>

                        <!-- Gender -->
                        <div class="col-12 col-md-6">
                            <label class="form-label text-muted small">Gender</label>
                            <div class="form-control bg-light border-0">{{ ucfirst($user->gender ?? 'Not specified') }}</div>
                        </div>

                        <!-- Date of Birth -->
                        <div class="col-12 col-md-6">
                            <label class="form-label text-muted small">Date of Birth</label>
                            <div class="form-control bg-light border-0">
                                {{ $user->date_of_birth ? $user->date_of_birth->format('F j, Y') : 'Not provided' }}
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="col-12">
                            <label class="form-label text-muted small">Address</label>
                            <div class="form-control bg-light border-0" style="min-height: 80px;">
                                @if($user->address || $user->city || $user->state || $user->pincode)
                                    {{ $user->address }}
                                    @if($user->city || $user->state || $user->pincode)
                                        <br>{{ $user->city }}{{ $user->city && $user->state ? ', ' : '' }}{{ $user->state }} {{ $user->pincode }}
                                    @endif
                                @else
                                    Not provided
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Account Info Card -->
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-header bg-transparent border-0 pt-4 pb-0">
                    <h5 class="fw-bold mb-0">
                        <i class="fas fa-shield-alt text-primary me-2"></i>Account Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-12 col-md-6">
                            <label class="form-label text-muted small">Account Created</label>
                            <div class="form-control bg-light border-0">
                                {{ $user->created_at->format('F j, Y') }}
                                <small class="text-muted">({{ $user->created_at->diffForHumans() }})</small>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label text-muted small">Email Verified</label>
                            <div class="form-control bg-light border-0">
                                @if($user->email_verified_at)
                                    <span class="text-success">
                                        <i class="fas fa-check-circle me-1"></i>
                                        Verified on {{ $user->email_verified_at->format('F j, Y') }}
                                    </span>
                                @else
                                    <span class="text-warning">
                                        <i class="fas fa-exclamation-circle me-1"></i>
                                        Not verified
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function previewPhoto(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profilePhotoPreview').src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
@endsection
