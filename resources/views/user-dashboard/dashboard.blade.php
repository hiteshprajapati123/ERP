@extends('layouts.user-dashboard')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="h3 mb-1 fw-bold">Welcome back, {{ auth()->user()->name }}! <span class="wave">👋</span></h1>
            <p class="text-muted mb-0">Here's your dashboard overview</p>
        </div>
        <div class="d-flex align-items-center bg-light rounded-pill px-3 py-2 shadow-sm">
            <i class="far fa-calendar-alt text-primary me-2"></i>
            <span class="fw-medium d-none d-sm-inline">{{ now()->format('l, F j, Y') }}</span>
            <span class="fw-medium d-inline d-sm-none">{{ now()->format('D, M j, y') }}</span>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 g-md-4 mb-4">
        <!-- Attendance Card -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm hover-lift">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="icon-wrapper bg-info bg-opacity-10 p-2 rounded-circle">
                            <i class="mdi mdi-chart-arc text-info" style="font-size: 1.5rem;"></i>
                        </div>
                        <div class="text-end">
                            <span class="text-muted small">OverAll</span>
                            <h3 class="mb-0 text-dark">{{ number_format($stats['attendance_percentage'] ?? 0, 1) }}%</h3>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted small">
                            <i class="fas fa-calendar-check text-success me-1"></i>
                            {{ $stats['present_days'] ?? 0 }} of {{ $stats['working_days'] ?? 0 }} days
                        </span>
                        <a href="{{ route('user.attendance.index') }}" class="btn btn-sm btn-link text-decoration-none p-0">
                            View Details <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                    <div class="progress mt-2" style="height: 4px;">
                        <div class="progress-bar bg-info" role="progressbar" 
                             style="width: {{ $stats['attendance_percentage'] ?? 0 }}%" 
                             aria-valuenow="{{ $stats['attendance_percentage'] ?? 0 }}" 
                             aria-valuemin="0" 
                             aria-valuemax="100">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Fees -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100 summary-card border-start-warning">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-1 w-100">
                                <h6 class="d-flex text-muted text-uppercase small fw-bold mb-0 me-2">
                                    <i class="fas fa-clock me-2"></i>Pending Fees
                                </h6>
                            </div>
                            <span class="badge bg-danger text-white small px-2 py-1" style="background-color: #dc3545 !important; font-weight: 500; letter-spacing: 0.5px; white-space: nowrap;">
                                <i class="fas fa-exclamation-triangle me-1"></i>Overdue Soon
                            </span>
                            <h3 class="text-warning mb-0">₹{{ number_format($stats['pending_fees']) }}</h3>

                            <div class="justify-content-between align-items-center">
                                    <i class="fas fa-clock text-warning me-2"></i>{{ $stats['pending_count'] }} installments
                            </div>
                        </div>
                    </div>
                    @if($stats['pending_count'] > 0)
                    <div class="alert alert-warning bg-warning bg-opacity-10 border-warning border-opacity-25 mt-3 mb-0 p-2 small">
                        <i class="fas fa-exclamation-circle text-warning me-2"></i>
                        You have {{ $stats['pending_count'] }} pending fee installments. Please clear them before the due date.
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Latest Exam -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0 fw-bold">Latest Exam</h5>
                    </div>
                    
                    @if($stats['latest_exam'])
                        <span class="badge bg-primary bg-opacity-10 text-primary small">
                            {{ \Carbon\Carbon::parse($stats['latest_exam']->created_at)->diffForHumans() }}
                        </span>
                    @endif

                    @if($stats['latest_exam'])
                        <div class="d-flex align-items-center bg-light rounded-3 p-3">
                            <div class="text-center me-3">
                                <div class="fw-bold text-primary">{{ \Carbon\Carbon::parse($stats['latest_exam']->date)->format('d') }}</div>
                                <div class="text-uppercase text-muted small">{{ \Carbon\Carbon::parse($stats['latest_exam']->date)->format('M') }}</div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1 fw-medium">{{ $stats['latest_exam']->exam_name }}</h6>
                                <div class="d-flex align-items-center mb-1">
                                    <span class="badge bg-{{ $stats['latest_exam']->percentage >= 50 ? 'success' : 'danger' }} bg-opacity-10 text-{{ $stats['latest_exam']->percentage >= 50 ? 'success' : 'danger' }} me-2">
                                        {{ number_format($stats['latest_exam']->percentage, 1) }}%
                                    </span>
                                    <small class="text-muted">{{ $stats['latest_exam']->obtained_marks }}/{{ $stats['latest_exam']->total_marks }} marks</small>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        <i class="fas fa-tag me-1"></i> {{ $stats['latest_exam']->grade }}
                                    </small>
                                    <small class="text-muted">
                                        <i class="far fa-clock me-1"></i> {{ \Carbon\Carbon::parse($stats['latest_exam']->created_at)->format('h:i A') }}
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="text-end mt-2">
                            <a href="{{ route('user.exam.results.index') }}" class="small text-primary text-decoration-none">View All Results</a>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-clipboard-list fa-2x text-muted mb-2"></i>
                            <p class="text-muted mb-0">No exam results found</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Widget -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold mb-4 d-flex align-items-center">
                        <i class="fas fa-bolt text-warning me-2"></i>
                        Quick Actions
                    </h5>
                    <div class="quick-actions-list">
                        <!-- Action 1 -->
                        <a href="{{ route('user.profile') }}" class="quick-action-item">
                            <div class="quick-action-icon bg-primary bg-opacity-10">
                                <i class="fas fa-user-edit text-primary"></i>
                            </div>
                            <div class="quick-action-content">
                                <h6 class="mb-0">Update Profile</h6>
                                <p class="text-muted mb-0 small">Edit your personal details</p>
                            </div>
                            <div class="quick-action-arrow">
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </a>
                        
                        <!-- Action 2 -->
                        <a href="{{ route('user.notices.index') }}" class="quick-action-item">
                            <div class="quick-action-icon bg-success bg-opacity-10">
                                <i class="fas fa-file-alt text-success"></i>
                            </div>
                            <div class="quick-action-content">
                                <h6 class="mb-0">My Notices</h6>
                                <p class="text-muted mb-0 small">View and download notices</p>
                            </div>
                            <div class="quick-action-arrow">
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </a>
                        
                        <!-- Action 3 -->
                        <a href="{{ route('user.fees') }}" class="quick-action-item">
                            <div class="quick-action-icon bg-info bg-opacity-10">
                                <i class="fas fa-credit-card text-info"></i>
                            </div>
                            <div class="quick-action-content">
                                <h6 class="mb-0">Fee Details</h6>
                                <p class="text-muted mb-0 small">View and pay fees</p>
                            </div>
                            <div class="quick-action-arrow">
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </a>
                        
                        <!-- Action 4 -->
                        <a href="#" class="quick-action-item" data-bs-toggle="modal" data-bs-target="#contactModal">
                            <div class="quick-action-icon bg-purple bg-opacity-10">
                                <i class="fas fa-headset text-purple"></i>
                            </div>
                            <div class="quick-action-content">
                                <h6 class="mb-0">Contact Us</h6>
                                <p class="text-muted mb-0 small">Get in touch with us</p>
                            </div>
                            <div class="quick-action-arrow">
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Us Modal -->
    <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: none;">
                <div class="modal-header" style="background: linear-gradient(rgba(26, 93, 59, 0.9), rgba(26, 93, 59, 0.8)); color: white; border: none; padding: 1.25rem 1.5rem;">
                    <h5 class="modal-title m-0" id="contactModalLabel" style="font-size: 1.25rem; font-weight: 600;">Get In Touch</h5>
                    <button type="button" class="btn-close btn-close-white m-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="contact-form">
                                <h2 style="font-size: 1.25rem; color: #1A5D3B; margin: 0 0 1.25rem; position: relative; padding-bottom: 0.75rem; text-align: center;">
                                    Send Us a Message
                                    <span style="position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); width: 40px; height: 2px; background: #D4AF37;"></span>
                                </h2>
                                
                                @if(session('status'))
                                    <div class="alert alert-{{ session('status') }} mb-3">
                                        {{ session('message') }}
                                    </div>
                                @endif

                                <form id="contactForm" action="{{ route('contact.submit') }}" method="POST" class="mt-3" onsubmit="event.preventDefault(); submitContactForm(this);">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label fw-medium text-dark">Your Name</label>
                                        <input type="text" name="name" value="{{ old('name') }}" required 
                                            class="form-control @error('name') is-invalid @enderror" 
                                            style="width: 100%; padding: 10px; border: 1px solid #e2e8f0; border-radius: 6px; transition: border-color 0.2s;">
                                        @error('name')
                                            <p class="text-danger text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label fw-medium text-dark">Email Address</label>
                                        <input type="email" name="email" value="{{ old('email') }}" required 
                                            class="form-control @error('email') is-invalid @enderror"
                                            style="width: 100%; padding: 10px; border: 1px solid #e2e8f0; border-radius: 6px; transition: border-color 0.2s;">
                                        @error('email')
                                            <p class="text-danger text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label fw-medium text-dark">Subject</label>
                                        <input type="text" name="subject" value="{{ old('subject') }}" required 
                                            class="form-control @error('subject') is-invalid @enderror"
                                            style="width: 100%; padding: 10px; border: 1px solid #e2e8f0; border-radius: 6px; transition: border-color 0.2s;">
                                        @error('subject')
                                            <p class="text-danger text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label class="form-label fw-medium text-dark">Your Message</label>
                                        <textarea name="message" rows="4" required 
                                            class="form-control @error('message') is-invalid @enderror"
                                            style="width: 100%; padding: 10px; border: 1px solid #e2e8f0; border-radius: 6px; transition: border-color 0.2s;">{{ old('message') }}</textarea>
                                        @error('message')
                                            <p class="text-danger text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div class="d-flex justify-content-end gap-2">
                                        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">
                                            <i class="fas fa-times me-1"></i> Close
                                        </button>
                                        <button type="submit" class="btn btn-primary btn-sm" style="background-color: #1A5D3B; border: none;" id="submitBtn">
                                            <i class="fas fa-paper-plane me-1"></i> Send Message
                                        </button>
                                    </div>
                                    
                                    <!-- Toast Notification (Moved outside modal) -->
                                    
                                    @push('scripts')
                                    <script>
                                        function submitContactForm(form) {
                                            const submitBtn = form.querySelector('button[type="submit"]');
                                            const originalBtnText = submitBtn.innerHTML;
                                            
                                            submitBtn.disabled = true;
                                            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Sending...';
                                            
                                            const formData = new FormData(form);
                                            const toastEl = document.getElementById('successToast');
                                            const toastMessage = document.getElementById('toastMessage');
                                            const toast = new bootstrap.Toast(toastEl);
                                            
                                            fetch(form.action, {
                                                method: 'POST',
                                                headers: {
                                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                                    'X-Requested-With': 'XMLHttpRequest',
                                                    'Accept': 'application/json'
                                                },
                                                body: formData
                                            })
                                            .then(async response => {
                                                const data = await response.json();
                                                if (!response.ok) {
                                                    throw data;
                                                }
                                                return data;
                                            })
                                            .then(data => {
                                                if (data.success) {
                                                    form.reset();
                                                    const modal = bootstrap.Modal.getInstance(document.getElementById('contactModal'));
                                                    modal.hide();
                                                    showToast('success', data.message || 'Your message has been sent successfully!');
                                                } else {
                                                    throw new Error(data.message || 'There was an error sending your message.');
                                                }
                                            })
                                            .catch(error => {
                                                console.error('Error:', error);
                                                const errorMessage = error.message || 
                                                                  (error.errors ? Object.values(error.errors).flat().join(' ') : null) || 
                                                                  'An error occurred. Please try again.';
                                                showToast('error', errorMessage);
                                            })
                                            .finally(() => {
                                                submitBtn.disabled = false;
                                                submitBtn.innerHTML = originalBtnText;
                                            });
                                        }
                                        
                                        function showToast(type, message) {
                                            const toastEl = document.getElementById('successToast');
                                            const toastMessage = document.getElementById('toastMessage');
                                            const toast = new bootstrap.Toast(toastEl, { autohide: true, delay: 5000 });
                                            
                                            // Set message
                                            toastMessage.textContent = message;
                                            
                                            // Update toast style based on type
                                            if (type === 'success') {
                                                toastEl.classList.remove('bg-danger');
                                                toastEl.classList.add('bg-success');
                                            } else {
                                                toastEl.classList.remove('bg-success');
                                                toastEl.classList.add('bg-danger');
                                            }
                                            
                                            // Show toast
                                            toast.show();
                                        }
                                        
                                        document.addEventListener('DOMContentLoaded', function() {
                                            const form = document.getElementById('contactForm');
                                            const modal = document.getElementById('contactModal');
                                            
                                            // Reset form when modal is closed
                                            modal.addEventListener('hidden.bs.modal', function () {
                                                form.reset();
                                                
                                                // Reset any error states
                                                const errorElements = form.querySelectorAll('.is-invalid');
                                                errorElements.forEach(el => {
                                                    el.classList.remove('is-invalid');
                                                });
                                            });
                                            
                                            // Clear validation errors when input changes
                                            form.querySelectorAll('input, textarea').forEach(input => {
                                                input.addEventListener('input', function() {
                                                    if (this.classList.contains('is-invalid')) {
                                                        this.classList.remove('is-invalid');
                                                        const errorElement = this.nextElementSibling;
                                                        if (errorElement && errorElement.classList.contains('text-danger')) {
                                                            errorElement.remove();
                                                        }
                                                    }
                                                });
                                            });
                                        });
                                        document.addEventListener('DOMContentLoaded', function() {
                                            const form = document.getElementById('contactForm');
                                            const submitBtn = document.getElementById('submitBtn');
                                            const modal = document.getElementById('contactModal');
                                            const toastEl = document.getElementById('successToast');
                                            const toastMessage = document.getElementById('toastMessage');
                                            const toast = new bootstrap.Toast(toastEl);
                                            
                                            form.addEventListener('submit', function(e) {
                                                e.preventDefault();
                                                
                                                submitBtn.disabled = true;
                                                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Sending...';
                                                
                                                // Create FormData object from the form
                                                const formData = new FormData(form);
                                                
                                                fetch(form.action, {
                                                    method: 'POST',
                                                    headers: {
                                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                                        'X-Requested-With': 'XMLHttpRequest',
                                                        'Accept': 'application/json'
                                                    },
                                                    body: formData
                                                })
                                                .then(async response => {
                                                    const data = await response.json();
                                                    
                                                    // If the response is not ok, throw an error with the response data
                                                    if (!response.ok) {
                                                        throw data;
                                                    }
                                                    return data;
                                                })
                                                .then(data => {
                                                    if (data.success) {
                                                        // Reset form
                                                        form.reset();
                                                        
                                                        // Close modal
                                                        const modalInstance = bootstrap.Modal.getInstance(modal);
                                                        modalInstance.hide();
                                                        
                                                        // Show success message
                                                        showToast('success', data.message || 'Your message has been sent successfully!');
                                                    } else {
                                                        throw new Error(data.message || 'There was an error sending your message.');
                                                    }
                                                })
                                                .catch(error => {
                                                    console.error('Error:', error);
                                                    const errorMessage = error.message || 
                                                                      (error.errors ? Object.values(error.errors).flat().join(' ') : null) || 
                                                                      'An error occurred. Please try again.';
                                                    showToast('error', errorMessage);
                                                })
                                                .finally(() => {
                                                    submitBtn.disabled = false;
                                                    submitBtn.innerHTML = '<i class="fas fa-paper-plane me-1"></i> Send Message';
                                                });
                                            });
                                            
                                            function showToast(type, message) {
                                                // Set message
                                                toastMessage.textContent = message;
                                                
                                                // Update toast style based on type
                                                if (type === 'success') {
                                                    toastEl.classList.remove('bg-danger');
                                                    toastEl.classList.add('bg-success');
                                                } else {
                                                    toastEl.classList.remove('bg-success');
                                                    toastEl.classList.add('bg-danger');
                                                }
                                                
                                                // Show toast
                                                toast.show();
                                                
                                                // Hide toast after 5 seconds
                                                setTimeout(() => {
                                                    toast.hide();
                                                }, 5000);
                                            }
                                            
                                            // Reset toast state when modal is closed
                                            modal.addEventListener('hidden.bs.modal', function () {
                                                // Reset form when modal is closed
                                                form.reset();
                                                
                                                // Reset any error states
                                                const errorElements = form.querySelectorAll('.is-invalid');
                                                errorElements.forEach(el => {
                                                    el.classList.remove('is-invalid');
                                                });
                                                
                                                // Reset toast to success state
                                                toastEl.classList.remove('bg-danger');
                                                toastEl.classList.add('bg-success');
                                            });
                                            
                                            // Clear validation errors when input changes
                                            form.querySelectorAll('input, textarea').forEach(input => {
                                                input.addEventListener('input', function() {
                                                    if (this.classList.contains('is-invalid')) {
                                                        this.classList.remove('is-invalid');
                                                        const errorElement = this.nextElementSibling;
                                                        if (errorElement && errorElement.classList.contains('text-danger')) {
                                                            errorElement.remove();
                                                        }
                                                    }
                                                });
                                            });
                                        });
                                    </script>
                                    @endpush
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Global Toast Notification (Moved outside modal) -->
<div class="position-fixed" style="z-index: 1100; bottom: 1rem; right: 1rem; left: 1rem; max-width: 400px; margin: 0 auto;">
    <div id="successToast" class="toast w-100" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex align-items-center p-2">
            <div class="toast-body d-flex align-items-center">
                <i class="fas fa-check-circle me-2" style="font-size: 1.25rem;"></i>
                <span id="toastMessage" class="me-2">Your message has been sent successfully!</span>
            </div>
            <button type="button" class="btn-close btn-close-white me-2" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

<style>
    /* Responsive toast styles */
    @media (max-width: 575.98px) {
        .toast {
            width: 100% !important;
            max-width: 100% !important;
            margin: 0.5rem 0;
            border-radius: 0.5rem;
        }
        
        .toast-body {
            padding: 0.75rem;
        }
    }
    
    /* Toast success/error states */
    .toast {
        background: #198754; /* Bootstrap success color as fallback */
        color: white;
        border: none;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    
    .toast.bg-success {
        background-color: #198754 !important;
    }
    
    .toast.bg-danger {
        background-color: #dc3545 !important;
    }
</style>

<style>
    /* Quick Actions List Style */
    .quick-actions-list {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        margin: 0;
        padding: 0;
        list-style: none;
    }
    
    .quick-action-item {
        display: flex;
        align-items: center;
        padding: 1rem 1.25rem;
        background: #fff;
        border-radius: 0.75rem;
        text-decoration: none;
        color: inherit;
        transition: all 0.2s ease;
        border: 1px solid rgba(0, 0, 0, 0.08);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }
    
    .quick-action-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        text-decoration: none;
    }
    
    .quick-action-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1.25rem;
        flex-shrink: 0;
    }
    
    .quick-action-icon i {
        font-size: 1.25rem;
    }
    
    .quick-action-content {
        flex-grow: 1;
        min-width: 0;
    }
    
    .quick-action-content h6 {
        font-size: 0.95rem;
        font-weight: 600;
        color: #1a202c;
        margin: 0 0 0.15rem 0;
        word-break: break-word;
        white-space: normal;
        overflow: visible;
        writing-mode: horizontal-tb;
        text-orientation: mixed;
    }
    
    .quick-action-content p {
        font-size: 0.8rem;
        color: #718096;
        margin: 0;
        word-break: break-word;
        white-space: normal;
        overflow: visible;
        writing-mode: horizontal-tb;
        text-orientation: mixed;
    }
    
    /* Mobile-specific adjustments */
    @media (max-width: 767.98px) {
        .quick-action-item {
            padding: 1rem;
            width: 100%;
            overflow: hidden;
            gap: 0.5rem; /* tighter spacing on mobile */
            flex-direction: column;      /* stack icon above text */
            align-items: center;         /* center contents */
            text-align: center;          /* center text */
        }

        .quick-action-content h6 {
            font-size: 1rem;
            line-height: 1.3;
            white-space: normal;          /* allow wrapping */
            overflow: hidden;             /* contain */
            display: -webkit-box;         /* show up to 2 lines */
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            writing-mode: horizontal-tb;
            text-orientation: mixed;
        }

        .quick-action-content p {
            font-size: 0.85rem;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            writing-mode: horizontal-tb;
            text-orientation: mixed;
            margin-bottom: 0;            /* tighten */
        }
        
        .quick-action-icon {
            width: 56px;                 /* larger, square tile */
            height: 56px;
            margin-right: 0;             /* center above text */
            margin-bottom: 0.25rem;
        }
        
        .quick-action-arrow {
            display: none;               /* hide arrow on mobile */
        }
    }
    
    .quick-action-arrow {
        color: #a0aec0;
        margin-left: 0.5rem;
        opacity: 0.7;
        display: flex;
        align-items: center;
    }
    
    /* Dark mode support */
    @media (prefers-color-scheme: dark) {
        .quick-action-item {
            background: #2d3748;
            border-color: #4a5568;
        }
        .quick-action-content h6 {
            color: #f7fafc;
        }
        .quick-action-content p {
            color: #a0aec0;
        }
    }
    .bg-purple {
        background-color: #6f42c1;
    }
    .text-purple {
        color: #6f42c1;
    }
    
    /* Base Styles */
    :root {
        --card-radius: 12px;
    }
    
    /* Card Hover Effect */
    .hover-lift {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    
    .hover-lift:hover {
        transform: translateY(-3px);
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.08) !important;
    }
    
    /* Icon Wrapper */
    .icon-wrapper {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }
    
    /* Progress Bar */
    .progress {
        border-radius: 100px;
        overflow: hidden;
    }
    
    /* Wave Animation */
    .wave {
        display: inline-block;
        animation: wave 2s infinite;
        transform-origin: 70% 70%;
    }
    
    @keyframes wave {
        0% { transform: rotate(0deg); }
        10% { transform: rotate(14deg); }
        20% { transform: rotate(-8deg); }
        30% { transform: rotate(14deg); }
        40% { transform: rotate(-4deg); }
        50% { transform: rotate(10deg); }
        60% { transform: rotate(0deg); }
        100% { transform: rotate(0deg); }
    }
    
    /* Activity Feed */
    .activity-item {
        transition: background-color 0.2s ease;
        padding: 1rem;
    }
    
    .activity-item:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }
    
    .activity-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .activity-content {
        flex: 1;
        min-width: 0; /* Prevents flex item from overflowing */
    }
    
    .activity-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        align-items: center;
    }
    
    .activity-meta .meta-item {
        display: inline-flex;
        align-items: center;
        white-space: nowrap;
    }
    
    .activity-meta .divider {
        color: #dee2e6;
        margin: 0 0.25rem;
    }

    
    
    /* Responsive Adjustments */
    @media (max-width: 767.98px) {
        .card-body {
            padding: 0.75rem;
        }
        
        .activity-item {
            padding: 0.75rem 0.5rem !important;
        }
        
        .activity-icon {
            width: 36px;
            height: 36px;
            font-size: 0.875rem;
            margin-right: 0.75rem !important;
        }
        
        .activity-item h6 {
            font-size: 0.9375rem;
            margin-bottom: 0.25rem;
        }
        
        .activity-meta {
            font-size: 0.75rem;
        }
        
        .activity-meta .divider {
            display: none;
        }
        
        .activity-meta .meta-item {
            margin-bottom: 0.25rem;
        }
        
        .badge {
            font-size: 0.7rem;
            padding: 0.25em 0.5em;
        }
    }
    
    @media (min-width: 992px) {
        .activity-feed {
            max-height: 400px;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #dee2e6 transparent;
        }
        
        .activity-feed::-webkit-scrollbar {
            width: 6px;
        }
        
        .activity-feed::-webkit-scrollbar-track {
            background: transparent;
        }
        
        .activity-feed::-webkit-scrollbar-thumb {
            background-color: #dee2e6;
            border-radius: 3px;
        }
    }
</style>
@endsection