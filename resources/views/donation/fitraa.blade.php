@extends('layouts.app')

@section('content')
@if(isset($fitraa) && $fitraa->is_active)
<div class="fitraa-page">
    <!-- Hero Section -->
    <section class="fitraa-hero bg-gradient-primary text-white text-center py-5">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="hero-content">
                        <i class="fas fa-hand-holding-heart display-3 mb-4"></i>
                        <h1 class="display-5 fw-bold mb-3">{{ $fitraa->hero_title }}</h1>
                        <p class="lead">{{ $fitraa->hero_quote }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- What is Fitraa Section -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    @if($fitraa->what_is_image)
                        <img src="{{ route('fitraa.files', $fitraa->what_is_image) }}" alt="{{ $fitraa->what_is_title }}" class="img-fluid rounded-3 shadow">
                    @else
                        <img src="https://img.freepik.com/free-vector/charity-donation-concept-illustration_114360-1444.jpg" alt="{{ $fitraa->what_is_title }}" class="img-fluid rounded-3 shadow">
                    @endif
                </div>
                <div class="col-lg-6">
                    <div class="ps-lg-5">
                        <h2 class="fw-bold mb-4">{{ $fitraa->what_is_title }}</h2>
                        <p class="lead text-muted">{{ $fitraa->what_is_content }}</p>
                        
                        @php
                            $benefits = !empty($fitraa->benefits) ? array_map('trim', explode(',', $fitraa->benefits)) : [];
                            $benefits = array_slice($benefits, 0, 5); // Ensure only 5 points
                        @endphp
                        
                        @if(!empty($benefits))
                        <div class="mt-4">
                            @foreach($benefits as $benefit)
                            <div class="d-flex mb-3">
                                <div class="me-3">
                                    <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-circle p-3">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                </div>
                                <div>
                                    <p class="mb-0">{{ $benefit }}</p>
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
                    <h2 class="fw-bold mb-4">{{ $fitraa->donation_title }}</h2>
                    <p class="lead text-muted mb-5">{{ $fitraa->donation_description }}</p>
                    
                    <div class="donation-card p-4 p-lg-5 bg-white rounded-3 shadow-sm">
                        <div class="donation-amount mb-4">
                            <h4 class="mb-3">Donation</h4>
                            <p class="text-muted">{{ $fitraa->donation_description }}</p>
                        </div>

                        <div class="qr-section my-5">
                            @if($fitraa->qr_code_image)
                            <div class="qr-container p-3 bg-white d-inline-block rounded-3 shadow-sm">
                                <img src="{{ route('fitraa.files', $fitraa->qr_code_image) }}" alt="Payment QR Code" class="img-fluid" style="max-width: 200px;">
                            </div>
                            <p class="text-muted mt-3">Scan to donate via UPI</p>
                            @else
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle me-2"></i> QR Code not available
                            </div>
                            @endif
                        </div>

                        <div class="donation-actions">
                            <button class="btn btn-primary btn-lg px-5 py-3" id="confirmDonation">
                                <i class="fas fa-check-circle me-2"></i> I have donated
                            </button>
                            @if($fitraa->donation_note)
                            <p class="text-muted small mt-3">{{ $fitraa->donation_note }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@else
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="alert alert-warning py-4">
                <i class="fas fa-exclamation-triangle fa-3x mb-3 text-warning"></i>
                <h3 class="mb-3">Fitraa Donation</h3>
                <p class="lead mb-0">The Fitraa donation page is currently not available. Please check back later.</p>
            </div>
        </div>
    </div>
</div>
@endif

<style>
    .alert-warning {
        background-color: #fff3cd;
        border-color: #ffeeba;
        color: #856404;
        border-radius: 0.5rem;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
    }
    .alert-warning i {
        margin-bottom: 1rem;
    }
    main {
        margin-top: 90px;
    }
</style>

<style>
    :root {
        --primary-color: #2ecc71;
        --primary-rgb: 46, 204, 113;
    }
    
    .fitraa-page {
        background-color: #f8f9fa;
    }
    
    .fitraa-hero {
        background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
        position: relative;
        overflow: hidden;
    }
    
    .fitraa-hero::before {
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
        background-color: #27ae60;
        border-color: #27ae60;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(46, 204, 113, 0.3);
    }
    
    .accordion-button:not(.collapsed) {
        background-color: rgba(46, 204, 113, 0.05);
        color: var(--primary-color);
    }
    
    .accordion-button:focus {
        border-color: rgba(46, 204, 113, 0.25);
        box-shadow: 0 0 0 0.25rem rgba(46, 204, 113, 0.25);
    }
    
    @media (max-width: 768px) {
        .fitraa-hero {
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
                    Thank you for your generous donation! May Allah accept it from you.
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
        
        // Amount selection
        const amountRadios = document.querySelectorAll('input[type="radio"][name="amount"]');
        const customAmount = document.querySelector('input[type="text"][placeholder="Other Amount"]');
        
        amountRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.checked) {
                    const amount = this.nextElementSibling.textContent.trim();
                    if (amount.startsWith('₹')) {
                        // Handle predefined amounts
                        customAmount.value = '';
                    } else {
                        // Handle custom amount
                        customAmount.focus();
                    }
                }
            });
        });
        
        customAmount.addEventListener('focus', function() {
            // Uncheck other radio buttons when custom amount is selected
            amountRadios.forEach(radio => {
                radio.checked = false;
            });
        });
    });
</script>
@endsection