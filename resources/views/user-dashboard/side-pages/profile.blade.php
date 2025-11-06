@extends('layouts.user-dashboard')

@section('title', 'My Profile')

@section('content')
<div class="profile-container">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-12">
                @if(session('alertType') && session('alertMessage'))
                <div class="alert alert-{{ session('alertType') }} alert-dismissible fade show d-flex align-items-center mb-4" role="alert">
                    <i class="fas {{ session('alertType') === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle' }} me-2"></i>
                    <div class="flex-grow-1">
                        @if(session('alertTitle'))
                            <h6 class="alert-heading mb-1 fw-bold">{{ session('alertTitle') }}</h6>
                        @endif
                        <div class="mb-0">{!! session('alertMessage') !!}</div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="card shadow-sm mb-4 border-0">
                    <div class="card-header py-3">
                        <h5 class="mb-0 fw-bold text-primary">
                            <i class="fas fa-user-circle me-2"></i> Profile Information
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                            @csrf
                            @method('PUT')
                            
                            <div class="text-center mb-4">
                                <div class="position-relative d-inline-block">
                                    <img id="profileImage" 
                                         src="{{ auth()->user()->profile_photo_url }}" 
                                         alt="Profile Image"
                                         class="rounded-circle border border-3 border-primary"
                                         style="width: 150px; height: 150px; object-fit: cover;">
                                    <label class="btn btn-primary btn-sm position-absolute bottom-0 end-0 rounded-circle" 
                                           style="width: 36px; height: 36px; line-height: 1; padding: 0;" 
                                           data-bs-toggle="tooltip" 
                                           title="Change photo">
                                        <i class="fas fa-camera mt-1"></i>
                                        <input type="file" 
                                               name="profile_photo" 
                                               id="profile_photo" 
                                               class="d-none" 
                                               accept="image/*">
                                    </label>
                                </div>
                            </div>

                            <div class="row g-3">
                                <!-- Personal Information -->
                                <div class="col-12">
                                    <h6 class="mb-3 fw-bold text-primary">
                                        <i class="fas fa-user-tie me-2"></i> Personal Information
                                    </h6>
                                </div>

                                <div class="col-md-6">
                                    <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        <input type="text" 
                                               class="form-control @error('name') is-invalid @enderror" 
                                               id="name" 
                                               name="name" 
                                               value="{{ old('name', auth()->user()->name) }}" 
                                               required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        <input type="email" 
                                               class="form-control @error('email') is-invalid @enderror" 
                                               id="email" 
                                               name="email" 
                                               value="{{ old('email', auth()->user()->email) }}" 
                                               required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        <input type="tel" 
                                               class="form-control @error('phone') is-invalid @enderror" 
                                               id="phone" 
                                               name="phone" 
                                               value="{{ old('phone', auth()->user()->phone) }}"
                                               required>
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="date_of_birth" class="form-label">Date of Birth</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                        <input type="date" 
                                               class="form-control @error('date_of_birth') is-invalid @enderror" 
                                               id="date_of_birth" 
                                               name="date_of_birth" 
                                               value="{{ old('date_of_birth', auth()->user()->date_of_birth ? \Carbon\Carbon::parse(auth()->user()->date_of_birth)->format('Y-m-d') : '') }}">
                                        @error('date_of_birth')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label for="gender" class="form-label">Gender</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                                        <select class="form-select @error('gender') is-invalid @enderror" 
                                                id="gender" 
                                               name="gender" 
                                               style="background-color: var(--card-bg); color: var(--text-primary);" 
                                               required>
                                            <option value="" disabled {{ old('gender', auth()->user()->gender) ? '' : 'selected' }}>Select Gender</option>
                                            <option value="male" {{ old('gender', auth()->user()->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                            <option value="female" {{ old('gender', auth()->user()->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                            <option value="other" {{ old('gender', auth()->user()->gender) == 'other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                        @error('gender')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Family Information -->
                                <div class="col-12 mt-4">
                                    <h6 class="mb-3 fw-bold text-primary">
                                        <i class="fas fa-users me-2"></i> Family Information
                                    </h6>
                                </div>

                                <div class="col-md-6">
                                    <label for="father_name" class="form-label">Father's Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-male"></i></span>
                                        <input type="text" 
                                               class="form-control @error('father_name') is-invalid @enderror" 
                                               id="father_name" 
                                               name="father_name" 
                                               value="{{ old('father_name', auth()->user()->father_name) }}" 
                                               style="background-color: var(--card-bg); color: var(--text-primary);">
                                        @error('father_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="mother_name" class="form-label">Mother's Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-female"></i></span>
                                        <input type="text" 
                                               class="form-control @error('mother_name') is-invalid @enderror" 
                                               id="mother_name" 
                                               name="mother_name" 
                                               value="{{ old('mother_name', auth()->user()->mother_name) }}" 
                                               style="background-color: var(--card-bg); color: var(--text-primary);">
                                        @error('mother_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Address Information -->
                                <div class="col-12 mt-4">
                                    <h6 class="mb-3 fw-bold text-primary">
                                        <i class="fas fa-map-marker-alt me-2"></i> Address Information
                                    </h6>
                                </div>

                                <div class="col-12">
                                    <label for="address" class="form-label">Full Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-home"></i></span>
                                        <textarea class="form-control @error('address') is-invalid @enderror" 
                                                  id="address" 
                                                  name="address" 
                                                  rows="2" 
                                                  style="background-color: var(--card-bg); color: var(--text-primary);">{{ old('address', auth()->user()->address) }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="city" class="form-label">City</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-city"></i></span>
                                        <input type="text" 
                                               class="form-control @error('city') is-invalid @enderror" 
                                               id="city" 
                                               name="city" 
                                               value="{{ old('city', auth()->user()->city) }}">
                                        @error('city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="state" class="form-label">State</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-flag"></i></span>
                                        <input type="text" 
                                               class="form-control @error('state') is-invalid @enderror" 
                                               id="state" 
                                               name="state" 
                                               value="{{ old('state', auth()->user()->state) }}">
                                        @error('state')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="pincode" class="form-label">Pincode</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-map-pin"></i></span>
                                        <input type="text" 
                                               class="form-control @error('pincode') is-invalid @enderror" 
                                               id="pincode" 
                                               name="pincode" 
                                               value="{{ old('pincode', auth()->user()->pincode) }}">
                                        @error('pincode')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="fas fa-save me-2"></i> Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('styles')
<style>
    /* Theme Variables */
    :root {
        --text-primary: #111827;
        --text-secondary: #4b5563;
        --text-muted: #6b7280;
        --bg-primary: #ffffff;
        --bg-secondary: #f9fafb;
        --border-color: #e5e7eb;
        --card-bg: #ffffff;
        --card-border: #e5e7eb;
        --input-bg: #ffffff;
        --input-border: #d1d5db;
        --input-text: #111827;
        --primary-color: #4f46e5;
        --primary-rgb: 79, 70, 229;
        --text-inverse: #ffffff;
    }
    
    /* Apply text colors */
    body {
        color: var(--text-primary);
    }

    .text-primary {
        color: var(--primary-color) !important;
    }

    .text-muted {
        color: var(--text-muted) !important;
    }

    .text-secondary {
        color: var(--text-secondary) !important;
    }
    
    /* Base Styles */
    body {
        background-color: var(--bg-secondary);
        color: var(--text-primary);
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    /* Card Styling */
    .card {
        background-color: var(--card-bg);
        border: 1px solid var(--border-color);
        color: var(--text-primary);
    }

    .card-header {
        background-color: var(--bg-secondary);
        border-bottom: 1px solid var(--border-color);
        color: var(--text-primary);
    }

    /* Form Elements */
    .form-label {
        color: var(--text-primary);
        font-weight: 500;
    }
    
    .form-control, .form-select, .form-control:disabled, .form-select:disabled {
        background-color: var(--card-bg);
        border-color: var(--card-border);
        color: var(--text-primary);
    }
    
    .form-control:focus, .form-select:focus {
        background-color: var(--card-bg);
        border-color: var(--primary-color);
        color: var(--text-primary);
        box-shadow: 0 0 0 0.25rem rgba(var(--primary-rgb), 0.25);
    }
    
    .form-control::placeholder {
        color: var(--text-muted);
        opacity: 0.7;
    }
    
    /* Input group text */
    .input-group-text {
        background-color: var(--card-bg);
        border-color: var(--card-border);
        color: var(--text-muted);
    }
    
    /* File input */
    .form-control[type="file"] {
        cursor: pointer;
    }
    
    /* Invalid feedback */
    .invalid-feedback {
        color: #dc3545;
    }
    
    /* Buttons */
    .btn-outline-secondary {
        color: var(--text-primary);
        border-color: var(--card-border);
    }
    
    .btn-outline-secondary:hover {
        background-color: var(--card-bg);
        border-color: var(--primary-color);
        color: var(--primary-color);
    }
    
    /* Input group styling */
    .input-group-text {
        background-color: #f8f9fa;
    }
    
    /* Form control sizing */
    .form-control, .form-select, .input-group-text {
        height: 42px;
    }
    
    .input-group-text {
        min-width: 42px;
        justify-content: center;
    }
    
    /* Ensure proper contrast in both light and dark modes */
    body {
        color: #212529; /* Dark gray that works well in light mode */
    }
    
    /* Dark mode overrides */
    @media (prefers-color-scheme: dark) {
        body {
            color: #f8f9fa; /* Light color for dark mode */
            background-color: #212529;
        }
        
        .card, .form-control, .form-select, .input-group-text {
            background-color: #2c3034;
            border-color: #373b3e;
            color: #f8f9fa;
        }
        
        .form-control:focus, .form-select:focus {
            background-color: #2c3034;
            color: #f8f9fa;
            border-color: #86b7fe;
        }
        
        .input-group-text {
            background-color: #373b3e;
            color: #f8f9fa;
        }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Initialize date picker with max date as today
    const today = new Date().toISOString().split('T')[0];
    const dobInput = document.getElementById('date_of_birth');
    if (dobInput) {
        dobInput.setAttribute('max', today);
    }
    
    // Handle profile picture preview
    const profileImage = document.getElementById('profileImage');
    const profilePhotoInput = document.getElementById('profile_photo');
    const profilePhotoLabel = profilePhotoInput?.parentElement;

    if (profilePhotoLabel) {
        profilePhotoLabel.addEventListener('click', function(e) {
            if (e.target === this) {
                profilePhotoInput.click();
            }
        });
    }

    if (profilePhotoInput) {
        profilePhotoInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    if (profileImage) {
                        profileImage.src = e.target.result;
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    }
    
    // Form validation with custom error messages
    (function () {
        'use strict';
        
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation');
        
        // Loop over them and prevent submission
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                    
                    // Scroll to first invalid field
                    const firstInvalid = form.querySelector(':invalid');
                    if (firstInvalid) {
                        firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        firstInvalid.focus();
                    }
                }
                
                form.classList.add('was-validated');
            }, false);
        });
        
        // Add real-time validation
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('input', function() {
                if (this.checkValidity()) {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                } else {
                    this.classList.remove('is-valid');
                    this.classList.add('is-invalid');
                }
            });
        });
    })();
    
    // Phone number formatting
    const phoneInput = document.getElementById('phone');
    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            let value = this.value.replace(/\D/g, '');
            if (value.length > 10) {
                value = value.substring(0, 10);
            }
            this.value = value;
        });
    }
});
</script>
@endpush

@endsection

@push('scripts')
<script>
    // Toggle password visibility
    const togglePassword = document.querySelector('.toggle-password');
    if (togglePassword) {
        togglePassword.addEventListener('click', function() {
            const passwordInput = document.querySelector('#password');
            if (passwordInput) {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                const icon = this.querySelector('i');
                if (icon) {
                    icon.classList.toggle('fa-eye');
                    icon.classList.toggle('fa-eye-slash');
                }
            }
        });
    }

// Profile specific JavaScript
</script>
@endpush