@extends('layouts.app')

@section('content')
<div class="notice-detail py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Back Button -->
                <div class="mb-4">
                    <a href="{{ route('notices.index') }}" class="btn btn-outline-secondary mb-4">
                        <i class="bi bi-arrow-left me-2"></i> Back to Notices
                    </a>
                </div>

                <!-- Main Card -->
                <div class="card border-0 shadow-sm">
                    <!-- Header with Gradient -->
                    <div class="notice-header" style="background: linear-gradient(135deg, #1A5D3B, #28a745);">
                        <div class="p-4">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <span class="badge rounded-pill px-3 py-2 mb-2" style="background: rgba(255,255,255,0.2); color: white;">
                                        @switch($notice->type)
                                            @case('event')
                                                <i class="bi bi-calendar-event me-1"></i> Event
                                                @break
                                            @case('exam')
                                                <i class="bi bi-file-earmark-text me-1"></i> Exam
                                                @break
                                            @case('course_material')
                                                <i class="bi bi-journal-bookmark me-1"></i> Course Material
                                                @break
                                            @default
                                                <i class="bi bi-megaphone me-1"></i> {{ ucfirst($notice->type) }}
                                        @endswitch
                                    </span>
                                    <h1 class="h3 text-white mb-3">{{ $notice->title }}</h1>
                                    <div class="d-flex flex-wrap gap-3 text-white-50">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-calendar3 me-2"></i>
                                            <span>Posted on {{ $notice->created_at->format('F j, Y') }}</span>
                                        </div>
                                        @if($notice->event_date)
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-clock-history me-2"></i>
                                            <span>Event: {{ $notice->event_date->format('F j, Y \\a\\t g:i A') }}</span>
                                        </div>
                                        @endif
                                        @if($notice->location)
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-geo-alt me-2"></i>
                                            <span>{{ $notice->location }}</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notice Content -->
                    <div class="card-body p-4">
                        @if($notice->image_path)
                            <div class="notice-image-container mb-4 rounded-3 overflow-hidden">
                                <img src="{{ asset('storage/' . $notice->image_path) }}" 
                                     alt="{{ $notice->title }}" 
                                     class="img-fluid w-100"
                                     style="max-height: 400px; object-fit: cover;">
                            </div>
                        @endif

                        <!-- Notice Description -->
                        <div class="notice-content mb-5">
                            <div class="prose max-w-none">
                                {!! nl2br(e($notice->description)) !!}
                            </div>
                        </div>

                        <!-- Attachments -->
                        @if($notice->file_path)
                        <div class="card border-0 bg-light mb-4">
                            <div class="card-body">
                                <h5 class="card-title d-flex align-items-center mb-3">
                                    <i class="bi bi-paperclip me-2"></i> Attachments
                                </h5>
                                <div class="d-flex align-items-center p-3 bg-white rounded-2">
                                    <div class="file-icon me-3">
                                        @if(str_contains($notice->file_type, 'pdf'))
                                            <i class="bi bi-file-earmark-pdf text-danger" style="font-size: 2.5rem;"></i>
                                        @elseif(str_contains($notice->file_type, 'word'))
                                            <i class="bi bi-file-earmark-word text-primary" style="font-size: 2.5rem;"></i>
                                        @elseif(str_contains($notice->file_type, 'excel'))
                                            <i class="bi bi-file-earmark-excel text-success" style="font-size: 2.5rem;"></i>
                                        @elseif(str_contains($notice->file_type, 'image'))
                                            <i class="bi bi-file-earmark-image text-info" style="font-size: 2.5rem;"></i>
                                        @else
                                            <i class="bi bi-file-earmark-text" style="font-size: 2.5rem;"></i>
                                        @endif
                                    </div>
                                    <div class="file-details flex-grow-1">
                                        <h6 class="mb-1 fw-bold">{{ $notice->file_name }}</h6>
                                        <p class="mb-0 text-muted small">
                                            {{ $notice->file_size }} • {{ strtoupper(pathinfo($notice->file_name, PATHINFO_EXTENSION)) }} File
                                        </p>
                                    </div>
                                    <a href="{{ route('notices.download', $notice) }}" class="btn btn-primary">
                                        <i class="bi bi-download me-1"></i> Download
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Contact Information -->
                        @if($notice->contact_person || $notice->contact_email || $notice->contact_phone)
                        <div class="card border-0 bg-light">
                            <div class="card-body">
                                <h5 class="card-title d-flex align-items-center mb-3">
                                    <i class="bi bi-person-lines-fill me-2"></i> Contact Information
                                </h5>
                                <div class="row g-3">
                                    @if($notice->contact_person)
                                    <div class="col-md-4">
                                        <div class="d-flex align-items-center p-3 bg-white rounded-2 h-100">
                                            <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-3">
                                                <i class="bi bi-person text-primary"></i>
                                            </div>
                                            <div>
                                                <p class="mb-0 small text-muted">Contact Person</p>
                                                <p class="mb-0 fw-medium">{{ $notice->contact_person }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    
                                    @if($notice->contact_email)
                                    <div class="col-md-4">
                                        <div class="d-flex align-items-center p-3 bg-white rounded-2 h-100">
                                            <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-3">
                                                <i class="bi bi-envelope text-primary"></i>
                                            </div>
                                            <div>
                                                <p class="mb-0 small text-muted">Email Address</p>
                                                <a href="mailto:{{ $notice->contact_email }}" class="text-decoration-none">
                                                    {{ $notice->contact_email }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    
                                    @if($notice->contact_phone)
                                    <div class="col-md-4">
                                        <div class="d-flex align-items-center p-3 bg-white rounded-2 h-100">
                                            <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-3">
                                                <i class="bi bi-telephone text-primary"></i>
                                            </div>
                                            <div>
                                                <p class="mb-0 small text-muted">Phone Number</p>
                                                <a href="tel:{{ $notice->contact_phone }}" class="text-decoration-none">
                                                    {{ $notice->contact_phone }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Footer -->
                    <div class="card-footer bg-transparent border-top-0 py-4 text-center d-flex justify-content-center">
                        <div class="text-muted small">
                            <i class="bi bi-info-circle me-1 text-muted"></i> Last updated {{ $notice->updated_at->diffForHumans() }}
                        </div>
                    </div>`
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .notice-detail {
        background-color: #f8f9fa;
    }
    
    .notice-header {
        border-radius: 0.5rem 0.5rem 0 0;
        position: relative;
        overflow: hidden;
    }
    
    .notice-header::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29-22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
        opacity: 0.5;
    }
    
    .notice-content {
        line-height: 1.8;
        color: #4a5568;
    }
    
    .notice-content h2,
    .notice-content h3,
    .notice-content h4 {
        margin-top: 1.5em;
        margin-bottom: 0.75em;
        color: #2d3748;
    }
    
    .notice-content p {
        margin-bottom: 1.2em;
    }
    
    .notice-content ul,
    .notice-content ol {
        padding-left: 1.5em;
        margin-bottom: 1.2em;
    }
    
    .notice-content li {
        margin-bottom: 0.5em;
    }
    
    .notice-content a {
        color: #1A5D3B;
        text-decoration: none;
        font-weight: 500;
    }
    
    .notice-content a:hover {
        text-decoration: underline;
    }
    
    .file-icon {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
    }
    
    .share-buttons .btn {
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }
    
    @media (max-width: 768px) {
        .notice-header {
            padding-top: 1.5rem !important;
            padding-bottom: 1.5rem !important;
        }
        
        .share-buttons {
            margin-top: 1rem;
        }
        
        .share-buttons .btn {
            width: 32px;
            height: 32px;
        }
    }
    
    main {
        margin-top: 70px;
    }
</style>

@push('scripts')
<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        
        // Copy link functionality
        var copyLinkBtn = document.querySelector('[data-bs-toggle="tooltip"][title="Copy link"]');
        if (copyLinkBtn) {
            copyLinkBtn.addEventListener('click', function(e) {
                e.preventDefault();
                var url = window.location.href;
                navigator.clipboard.writeText(url).then(function() {
                    var tooltip = bootstrap.Tooltip.getInstance(copyLinkBtn);
                    var originalTitle = copyLinkBtn.getAttribute('data-bs-original-title');
                    copyLinkBtn.setAttribute('data-bs-original-title', 'Link copied!');
                    tooltip.show();
                    
                    setTimeout(function() {
                        copyLinkBtn.setAttribute('data-bs-original-title', originalTitle);
                    }, 2000);
                });
            });
        }
    });
</script>
@endpush
@endsection