@extends('layouts.app')

@section('content')
<main class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header bg-gradient-success text-white py-4">
                        <h2 class="text-center mb-0">Registration Successful!</h2>
                    </div>
                    <div class="card-body p-5 text-center">
                        <div class="mb-4">
                            <div class="d-flex justify-content-center mb-4">
                                <div class="rounded-circle bg-success bg-opacity-10 d-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                                    <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                                </div>
                            </div>
                            <h3 class="text-success mb-3">Thank You for Registering!</h3>
                            <p class="lead mb-4">Your registration has been received successfully.</p>
                            <p class="text-muted mb-4">We've sent a confirmation email to your registered email address. Please check your inbox (and spam folder) for further details.</p>
                        </div>
                        
                        <div class="d-grid gap-3 d-md-flex justify-content-center">
                            <a href="{{ route('home') }}" class="btn btn-primary px-4 py-2">
                                <i class="fas fa-home me-2"></i>Back to Home
                            </a>
                            <a href="{{ route('events.index') }}" class="btn btn-outline-secondary px-4 py-2">
                                <i class="fas fa-calendar-alt me-2"></i>View Other Events
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
    
    main {
        margin-top: 90px;
    }
    body {
        font-family: 'Inter', sans-serif;
    }

    .card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .card-header {
        background: linear-gradient(90deg, #28a745, #20c997);
        border-bottom: none;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #28a745, #20c997);
        border: none;
        border-radius: 10px;
        padding: 0.75rem 2rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
    }
    
    .btn-outline-secondary {
        border-radius: 10px;
        padding: 0.75rem 2rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn-outline-secondary:hover {
        background:rgb(80, 75, 74);
        transform: translateY(-2px);
    }
</style>
@endsection
