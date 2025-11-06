@extends('layouts.app')

@section('content')
@if(isset($sadqa) && $sadqa->is_active)
<div class="sadqa-page">
    <!-- Hero Section -->
    <section class="sadqa-hero bg-gradient-primary text-white text-center py-5" style="background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="hero-content">
                        <i class="fas fa-heart display-3 mb-4"></i>
                        <h1 class="display-5 fw-bold mb-3">{{ $sadqa->hero_title }}</h1>
                        <p class="lead">{{ $sadqa->hero_quote }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- What is Sadaqah Section -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="{{ $sadqa->what_is_image ? asset('storage/' . $sadqa->what_is_image) : 'https://img.freepik.com/free-vector/charity-donation-concept-illustration_114360-1444.jpg' }}" alt="{{ $sadqa->what_is_title }}" class="img-fluid rounded-3 shadow">
                </div>
                <div class="col-lg-6">
                    <div class="ps-lg-5">
                        <h2 class="fw-bold mb-4">{{ $sadqa->what_is_title }}</h2>
                        <p class="lead text-muted">{{ $sadqa->what_is_content }}</p>
                        
                        @if(!empty($sadqa->decoded_benefits))
                        <div class="mt-4">
                            @foreach($sadqa->decoded_benefits as $benefit)
                            <div class="d-flex mb-3">
                                <div class="me-3">
                                    <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-circle p-3">
                                        <i class="fas fa-{{ $benefit['icon'] ?? 'heart' }}"></i>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-1">{{ $benefit['title'] ?? '' }}</h5>
                                    <p class="text-muted mb-0">{{ $benefit['description'] ?? '' }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Donation Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="fw-bold mb-4">{{ $sadqa->donation_title }}</h2>
                    <p class="lead text-muted mb-5">{{ $sadqa->donation_description }}</p>
                    
                    <div class="donation-card p-4 p-lg-5 bg-white rounded-3 shadow-sm">
                        <div class="qr-section my-5">
                            <div class="qr-container p-3 bg-white d-inline-block rounded-3 shadow-sm">
                                <img src="{{ $sadqa->qr_code_image ? asset('storage/' . $sadqa->qr_code_image) : asset('img/qr-code-placeholder.png') }}" alt="Payment QR Code" class="img-fluid" style="max-width: 200px;">
                            </div>
                            <p class="text-muted mt-3">Scan to donate via UPI</p>
                        </div>

                        <div class="donation-actions">
                            <button class="btn btn-primary btn-lg px-5 py-3" id="confirmDonation">
                                <i class="fas fa-check-circle me-2"></i> I have donated
                            </button>
                            <p class="text-muted small mt-3">{{ $sadqa->donation_note }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    :root {
        --primary-color: #3498db;
        --primary-rgb: 52, 152, 219;
    }
    
    .sadqa-page {
        background-color: #f8f9fa;
    }
    
    .sadqa-hero {
        position: relative;
        overflow: hidden;
    }
    
    .sadqa-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
        opacity: 0.5;
    }
    
    .icon-box {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    
    .donation-card {
        border: 1px solid rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    
    .donation-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
    }
    
    .btn-outline-primary {
        color: var(--primary-color);
        border-color: var(--primary-color);
    }
    
    .btn-outline-primary:hover, 
    .btn-outline-primary:active,
    .btn-outline-primary:focus {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
    }
    
    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }
    
    .btn-primary:hover,
    .btn-primary:active,
    .btn-primary:focus {
        background-color: #2980b9;
        border-color: #2980b9;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
    }
    
    .accordion-button:not(.collapsed) {
        background-color: rgba(52, 152, 219, 0.05);
        color: var(--primary-color);
    }
    
    .accordion-button:focus {
        border-color: rgba(52, 152, 219, 0.25);
        box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
    }
    
    @media (max-width: 768px) {
        .sadqa-hero {
            padding: 3rem 0;
        }
        
        .hero-content h1 {
            font-size: 2.2rem;
        }
        
        .donation-amount .btn {
            margin: 5px;
        }
    }

    main {
        margin-top: 90px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animation for donation confirmation
        const confirmBtn = document.getElementById('confirmDonation');
        if (confirmBtn) {
            confirmBtn.addEventListener('click', function() {
                // Show success message
                const alert = document.createElement('div');
                alert.className = 'alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3';
                alert.style.zIndex = '9999';
                alert.style.minWidth = '300px';
                alert.role = 'alert';
                alert.innerHTML = `
                    <i class="fas fa-check-circle me-2"></i>
                    Thank you for your generous Sadaqah! May Allah accept it from you.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                `;
                document.body.appendChild(alert);
                
                // Remove alert after 5 seconds
                setTimeout(() => {
                    alert.classList.remove('show');
                    setTimeout(() => {
                        alert.remove();
                    }, 300);
                }, 5000);
            });
        }
    });
</script>
@endif
@endsection