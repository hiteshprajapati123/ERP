@extends('layouts.app')

@section('content')
<main class="py-5">
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-gradient-primary text-white py-4">
                    <h2 class="text-center mb-0">Event Registration</h2>
                    @if(isset($event))
                    <h4 class="text-center mt-2 mb-0">{{ $event->title }}</h4>
                    @endif
                </div>
                <div class="card-body p-5">
                    <form action="{{ route('events.register', $event) }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        @if(isset($event))
                            <input type="hidden" name="event_id" value="{{ $event->id }}">
                        @endif

                        <div class="form-section">
                            <h5 class="text-primary mb-4">Personal Information</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('full_name') is-invalid @enderror" 
                                            id="full_name" name="full_name" 
                                            value="{{ old('full_name') }}" 
                                            placeholder="Full Name" required>
                                        <label for="full_name">Full Name <span class="text-danger">*</span></label>
                                        @error('full_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                            id="email" name="email" 
                                            value="{{ old('email') }}" 
                                            placeholder="Email Address" required>
                                        <label for="email">Email Address <span class="text-danger">*</span></label>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                            id="phone" name="phone" 
                                            value="{{ old('phone') }}" 
                                            placeholder="Phone Number" required>
                                        <label for="phone">Phone Number <span class="text-danger">*</span></label>
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('roll_number') is-invalid @enderror" 
                                            id="roll_number" name="roll_number" 
                                            value="{{ old('roll_number') }}" 
                                            placeholder="Roll Number" required>
                                        <label for="roll_number">Roll Number <span class="text-danger">*</span></label>
                                        @error('roll_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <h5 class="text-primary mb-4">Address Information</h5>
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control @error('address') is-invalid @enderror" 
                                            id="address" name="address" 
                                            placeholder="Full Address" 
                                            style="height: 100px" required>{{ old('address') }}</textarea>
                                        <label for="address">Full Address <span class="text-danger">*</span></label>
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                            id="city" name="city" 
                                            value="{{ old('city') }}" 
                                            placeholder="City" required>
                                        <label for="city">City <span class="text-danger">*</span></label>
                                        @error('city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('state') is-invalid @enderror" 
                                            id="state" name="state" 
                                            value="{{ old('state') }}" 
                                            placeholder="State" required>
                                        <label for="state">State <span class="text-danger">*</span></label>
                                        @error('state')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('pincode') is-invalid @enderror" 
                                            id="pincode" name="pincode" 
                                            value="{{ old('pincode') }}" 
                                            placeholder="Pincode" required>
                                        <label for="pincode">Pincode <span class="text-danger">*</span></label>
                                        @error('pincode')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary me-md-2 px-4">
                                <i class="fas fa-arrow-left me-2"></i>Back
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-paper-plane me-2"></i>Submit Registration
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
    main {
        background: linear-gradient(135deg, #b8f1d6, #7ad1b8, #4ca1a3);
        background-size: 300% 300%;
        animation: gradientFlow 10s ease infinite;
        min-height: 100vh;
    }
    
    @media (min-width: 768px) {
        main {
            padding-top: 70px; /* Keep original padding for larger screens */
        }
    }

    @keyframes gradientFlow {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(12px);
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.2);
    }

    .card-header {
        background: linear-gradient(90deg, #1b8455, #2aa876);
        border-radius: 0 !important;
        padding: 1.5rem 2rem;
    }

    .card-header h2, .card-header h4 {
        color: white;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .card-body {
        padding: 2.5rem;
    }

    .form-floating>label {
        padding: 1rem 0.75rem;
        color: #5a6c75;
        font-weight: 500;
    }

    .form-control {
        border-radius: 12px;
        border: 1px solid #e0e6ed;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.8);
    }

    .form-control:focus {
        border-color: #2aa876;
        box-shadow: 0 0 0 0.25rem rgba(42, 168, 118, 0.25);
        background: white;
    }

    .form-section {
        background: rgba(255, 255, 255, 0.7);
        border-radius: 15px;
        padding: 2rem;
        margin-bottom: 2rem;
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .form-section h5 {
        color: #1b8455;
        font-weight: 600;
        margin-bottom: 1.5rem;
        position: relative;
        padding-bottom: 0.75rem;
    }

    .form-section h5:after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 50px;
        height: 3px;
        background: linear-gradient(90deg, #1b8455, #2aa876);
        border-radius: 3px;
    }

    .btn-primary {
        background: linear-gradient(135deg, #1b8455, #2aa876);
        border: none;
        border-radius: 10px;
        padding: 0.75rem 2rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(43, 168, 119, 0.3);
    }

    .btn-primary:hover, .btn-primary:focus {
        background: linear-gradient(135deg, #147a4a, #1e8d5f);
        transform: translateY(-2px);
        box-shadow: 0 7px 20px rgba(43, 168, 119, 0.4);
    }

    .btn-outline-secondary {
        border-radius: 10px;
        padding: 0.75rem 2rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-outline-secondary:hover {
        background: #f8f9fa;
        transform: translateY(-2px);
    }

    .invalid-feedback {
        font-size: 0.85rem;
        margin-top: 0.5rem;
    }

    @media (max-width: 768px) {
        .card-body {
            padding: 1.5rem;
        }
        
        .form-section {
            padding: 1.5rem;
        }
    }
</style>

<script>
// Form validation
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
</script>
@endsection