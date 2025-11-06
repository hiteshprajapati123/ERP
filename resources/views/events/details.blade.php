@extends('layouts.app', ['title' => $event['title'] . ' - Events'])

@section('content')
<!-- Event Hero Section -->
<section style="background: linear-gradient(rgba(26, 93, 59, 0.9), rgba(26, 93, 59, 0.8)), url('{{ $event['image'] }}'); background-size: cover; background-position: center; padding: 100px 0 60px; color: white; text-align: center; position: relative;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="event-header-content" style="position: relative; z-index: 2;">
                    <div style="background: rgba(212, 175, 55, 0.9); color: #1A5D3B; display: inline-block; padding: 5px 20px; border-radius: 30px; font-weight: 600; margin-bottom: 20px; font-size: 15px;">
                        {{ $event['category'] }}
                    </div>
                    <h1 style="font-size: 42px; margin: 0 0 15px; font-weight: 700; line-height: 1.3;">{{ $event['title'] }}</h1>
                    <div style="display: flex; justify-content: center; flex-wrap: wrap; gap: 20px; margin-top: 25px;">
                        <div style="display: flex; align-items: center; background: rgba(255, 255, 255, 0.15); padding: 8px 20px; border-radius: 50px; backdrop-filter: blur(5px);">
                            <i class="far fa-calendar-alt me-2"></i>
                            <span>{{ $event['date'] }}</span>
                        </div>
                        <div style="display: flex; align-items: center; background: rgba(255, 255, 255, 0.15); padding: 8px 20px; border-radius: 50px; backdrop-filter: blur(5px);">
                            <i class="far fa-clock me-2"></i>
                            <span>{{ $event['time'] }}</span>
                        </div>
                        <div style="display: flex; align-items: center; background: rgba(255, 255, 255, 0.15); padding: 8px 20px; border-radius: 50px; backdrop-filter: blur(5px);">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            <span>{{ $event['location'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="position: absolute; bottom: -1px; left: 0; width: 100%; overflow: hidden; line-height: 0; transform: rotate(180deg);">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none" style="width: calc(100% + 1.3px); height: 100px;">
            <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" fill="#f8f9fa"></path>
            <path d="M0,0v15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,141.56,70.1,13.21,22.27,17.51,51.63,9.89,77.62-9.06,39.03-40.1,61.38-83.08,65.28-38.8,3.55-81.94-7.51-115.49-20.6-31.3-12.39-72.54-28.73-94.62-60.08-4.25-6.04-7.58-13.31-7.35-20.1.33-9.54,6.53-18.09,15.38-21.27,14.13-5.11,30.64,1.18,43.74,11.3,14.37,11.06,23.7,26.36,34.6,40.21,1.43,1.83,2.9,3.63,4.4,5.4,19.1-14.49,35.79-31.94,46.26-51.61-21.09-2.83-42.53-1.3-62.46,5.66-31.7,11.03-58.5,31.07-82.6,52.34-30.5,26.93-54.7,61.2-76.19,94.06V0Z" opacity=".5" fill="#f8f9fa"></path>
            <path d="M0,0v5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" fill="#f8f9fa"></path>
        </svg>
    </div>
</section>

<!-- Event Details Section -->
<section style="padding: 80px 0; background: #f8f9fa;">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <div style="background: white; border-radius: 12px; padding: 40px; box-shadow: 0 5px 30px rgba(0,0,0,0.05); margin-bottom: 30px;">
                    <h2 style="color: #1A5D3B; margin-bottom: 25px; position: relative; padding-bottom: 15px;">
                        About This Event
                        <span style="position: absolute; bottom: 0; left: 0; width: 60px; height: 3px; background: #D4AF37;"></span>
                    </h2>
                    <div style="line-height: 1.8; color: #4a5568; margin-bottom: 30px;">
                        {!! nl2br(e($event['description'])) !!}
                    </div>

                    <!-- Event Images Gallery -->
                    @if(isset($event['images']) && count($event['images']) > 0)
                    <div style="margin: 50px -15px 0;">
                        <h3 style="color: #1A5D3B; margin-bottom: 20px; font-size: 22px; position: relative; padding-bottom: 10px; padding: 0 15px;">
                            Event Gallery
                            <span style="position: absolute; bottom: 0; left: 15px; width: 40px; height: 2px; background: #D4AF37;"></span>
                        </h3>
                        <div class="row g-3" style="margin: 0;">
                            @foreach($event['images'] as $image)
                            <div class="col-6 col-sm-4 col-md-3" style="padding: 8px;">
                                <a href="{{ $image }}" data-lightbox="event-gallery" 
                                   style="display: block; height: 0; padding-bottom: 100%; position: relative; overflow: hidden; border-radius: 8px; box-shadow: 0 3px 10px rgba(0,0,0,0.1); transition: all 0.3s ease;"
                                   onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.15)'" 
                                   onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 3px 10px rgba(0,0,0,0.1)'">
                                    <img src="{{ $image }}" alt="Event Image" 
                                         style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;"
                                         onmouseover="this.style.transform='scale(1.05)'"
                                         onmouseout="this.style.transform='scale(1)'">
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @if(isset($event['details']) && count($event['details']) > 0)
                    <div style="margin-top: 40px;">
                        <h3 style="color: #1A5D3B; margin-bottom: 20px; font-size: 22px; position: relative; padding-bottom: 10px;">
                            Event Details
                            <span style="position: absolute; bottom: 0; left: 0; width: 40px; height: 2px; background: #D4AF37;"></span>
                        </h3>
                        <ul style="list-style: none; padding: 0; margin: 0;">
                            @foreach($event['details'] as $detail)
                            <li style="padding: 8px 0; border-bottom: 1px solid #edf2f7; display: flex; align-items: flex-start;">
                                <i class="fas fa-check-circle" style="color: #1A5D3B; margin-right: 10px; margin-top: 5px; font-size: 14px;"></i>
                                <span>{{ $detail }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div style="background: white; border-radius: 12px; padding: 30px; box-shadow: 0 5px 30px rgba(0,0,0,0.05); position: sticky; top: 30px;">
                    <h3 style="color: #1A5D3B; margin-bottom: 25px; font-size: 22px; position: relative; padding-bottom: 15px;">
                        Event Info
                        <span style="position: absolute; bottom: 0; left: 0; width: 40px; height: 3px; background: #D4AF37;"></span>
                    </h3>
                    
                    <div style="margin-bottom: 25px;">
                        <div style="display: flex; margin-bottom: 15px;">
                            <div style="width: 40px; height: 40px; background: rgba(26, 93, 59, 0.1); border-radius: 8px; display: flex; align-items: center; justify-content: center; margin-right: 15px; flex-shrink: 0;">
                                <i class="far fa-calendar-alt" style="color: #1A5D3B; font-size: 18px;"></i>
                            </div>
                            <div>
                                <div style="font-size: 13px; color: #718096; margin-bottom: 3px;">Date & Time</div>
                                <div style="font-weight: 600; color: #2d3748;">{{ $event['date'] }} at {{ $event['time'] }}</div>
                            </div>
                        </div>
                        
                        <div style="display: flex; margin-bottom: 15px;">
                            <div style="width: 40px; height: 40px; background: rgba(26, 93, 59, 0.1); border-radius: 8px; display: flex; align-items: center; justify-content: center; margin-right: 15px; flex-shrink: 0;">
                                <i class="fas fa-map-marker-alt" style="color: #1A5D3B; font-size: 18px;"></i>
                            </div>
                            <div>
                                <div style="font-size: 13px; color: #718096; margin-bottom: 3px;">Location</div>
                                <div style="font-weight: 600; color: #2d3748;">{{ $event['location'] }}</div>
                            </div>
                        </div>
                        
                        @if(isset($event['contact_person']) || isset($event['contact_email']) || isset($event['contact_phone']))
                        <div style="display: flex; margin-bottom: 15px;">
                            <div style="width: 40px; height: 40px; background: rgba(26, 93, 59, 0.1); border-radius: 8px; display: flex; align-items: center; justify-content: center; margin-right: 15px; flex-shrink: 0;">
                                <i class="far fa-user" style="color: #1A5D3B; font-size: 18px;"></i>
                            </div>
                            <div>
                                <div style="font-size: 13px; color: #718096; margin-bottom: 3px;">Contact Person</div>
                                <div style="font-weight: 600; color: #2d3748;">
                                    @if(isset($event['contact_person']))
                                        {{ $event['contact_person'] }}<br>
                                    @endif
                                    @if(isset($event['contact_email']))
                                        <a href="mailto:{{ $event['contact_email'] }}" style="color: #1A5D3B; text-decoration: none;">{{ $event['contact_email'] }}</a><br>
                                    @endif
                                    @if(isset($event['contact_phone']))
                                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $event['contact_phone']) }}" style="color: #1A5D3B; text-decoration: none;">{{ $event['contact_phone'] }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    
                    @php
                        $isRegistered = false;
                        if (auth()->check() && isset($event['id'])) {
                            $isRegistered = \App\Models\Event::find($event['id'])->isRegistered(auth()->id());
                        }
                        $isFull = isset($event['max_attendees']) && $event['registrations_count'] >= $event['max_attendees'];
                    @endphp

                    @if($isRegistered)
                        <button class="btn btn-secondary w-100" style="border: none; padding: 12px; font-weight: 600; font-size: 16px; border-radius: 8px; margin-bottom: 20px;" disabled>
                            <i class="fas fa-check-circle me-2"></i> Already Registered
                        </button>
                    @elseif($isFull)
                        <button class="btn btn-danger w-100" style="border: none; padding: 12px; font-weight: 600; font-size: 16px; border-radius: 8px; margin-bottom: 20px;" disabled>
                            <i class="fas fa-times-circle me-2"></i> Event Full
                        </button>
                    @else
                        <a href="{{ route('event.registration.create', $event['title']) }}" 
                           class="btn btn-primary w-100" 
                           style="border: none; padding: 12px; font-weight: 600; font-size: 16px; border-radius: 8px; margin-bottom: 20px; text-decoration: none; display: block;"
                           onmouseover="this.style.backgroundColor='#14482d'" 
                           onmouseout="this.style.backgroundColor='#1A5D3B'">
                            <i class="fas fa-user-plus me-2"></i> Register Now
                        </a>

                    @endif
                    <div id="registrationMessage" class="mt-2"></div>
                    
                    <div style="font-size: 13px; color: #718096; text-align: center;">
                        <i class="fas fa-lock me-2"></i> Secure registration
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section style="padding: 80px 0; background: linear-gradient(135deg, #1A5D3B 0%, #14482d 100%); position: relative; overflow: hidden;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <h2 style="color: white; font-size: 36px; margin-bottom: 20px; font-weight: 700;">Ready to Join Our Community?</h2>
                <p style="color: rgba(255,255,255,0.9); font-size: 18px; margin-bottom: 30px; max-width: 700px; margin-left: auto; margin-right: auto; line-height: 1.7;">
                    Stay updated with our latest events and activities. Join our community today and be part of something meaningful.
                </p>
                <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
                    <a href="/events" class="btn btn-light" style="background: white; color: #1A5D3B; padding: 12px 30px; border-radius: 50px; font-weight: 600; text-decoration: none; transition: all 0.3s ease; border: 2px solid white;"
                       onmouseover="this.style.backgroundColor='transparent'; this.style.color='white'" 
                       onmouseout="this.style.backgroundColor='white'; this.style.color='#1A5D3B'">
                        View All Events
                    </a>
                    <a href="/contact" class="btn btn-outline-light" style="background: transparent; color: white; padding: 12px 30px; border-radius: 50px; font-weight: 600; text-decoration: none; transition: all 0.3s ease; border: 2px solid white;"
                       onmouseover="this.style.backgroundColor='white'; this.style.color='#1A5D3B'" 
                       onmouseout="this.style.backgroundColor='transparent'; this.style.color='white'">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Decorative Elements -->
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0.1; pointer-events: none;">
        <div style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; border: 2px solid rgba(255,255,255,0.5); border-radius: 50%;"></div>
        <div style="position: absolute; bottom: -100px; left: -50px; width: 300px; height: 300px; border: 2px solid rgba(255,255,255,0.3); border-radius: 50%;"></div>
    </div>
</section>

<style>
    /* Responsive styles */
    @media (max-width: 991px) {
        .event-header-content h1 {
            font-size: 32px !important;
        }
        
        .event-header-content .btn {
            padding: 10px 20px !important;
            font-size: 14px !important;
        }
        
        .event-meta span {
            margin-bottom: 10px;
        }
    }
    
    @media (max-width: 767px) {
        .event-header-content h1 {
            font-size: 28px !important;
        }
        
        .event-header-content .btn {
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }
        
        .event-meta {
            flex-direction: column;
            align-items: flex-start !important;
        }
        
        .event-meta > div {
            margin-bottom: 10px;
            width: 100%;
        }
    }
    
    /* Animation for elements */
    .fade-in {
        animation: fadeIn 0.6s ease-in-out;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    /* Hover effects */
    .event-card-hover {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .event-card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important;
    }
    
    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }
    
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    
    ::-webkit-scrollbar-thumb {
        background: #1A5D3B;
        border-radius: 4px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: #14482d;
    }
</style>

<!-- Add smooth scrolling -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle registration form submission
        const registrationForm = document.getElementById('eventRegistrationForm');
        if (registrationForm) {
            registrationForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalBtnText = submitBtn.innerHTML;
                
                // Show loading state
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...';
                
                fetch(this.action, {
                    method: 'POST',
                    body: new FormData(this),
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    const messageDiv = document.getElementById('registrationMessage');
                    if (data.success) {
                        messageDiv.innerHTML = `
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                ${data.message || 'Registration successful!'}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        `;
                        
                        // Close modal and reload page after delay
                        const modal = bootstrap.Modal.getInstance(document.getElementById('registrationModal'));
                        modal.hide();
                        
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    } else {
                        throw new Error(data.message || 'Registration failed');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    const messageDiv = document.getElementById('registrationMessage');
                    messageDiv.innerHTML = `
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            ${error.message || 'An error occurred. Please try again.'}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `;
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnText;
                });
            });
        }
        
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
        
        // Add animation class to elements when they come into view
        const animateOnScroll = () => {
            const elements = document.querySelectorAll('.fade-in');
            elements.forEach(element => {
                const elementPosition = element.getBoundingClientRect().top;
                const screenPosition = window.innerHeight / 1.3;
                
                if (elementPosition < screenPosition) {
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }
            });
        };
        
        // Initial check
        animateOnScroll();
        
        // Check on scroll
        window.addEventListener('scroll', animateOnScroll);
    });
</script>
@endsection
