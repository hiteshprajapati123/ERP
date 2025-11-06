@extends('layouts.app')

@section('content')
<div class="notice-board py-5">
    <div class="container">
        <!-- Page Header -->
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold text-primary mb-3">Notices & Announcements</h1>
            <p class="lead text-muted">Stay updated with the latest news and events from our institution</p>
            <div class="divider mx-auto bg-primary" style="width: 80px; height: 4px; background: linear-gradient(90deg, #1A5D3B, #28a745);"></div>
        </div>

        <!-- Search and Filter -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <form action="{{ route('notices.index') }}" method="GET" class="row g-3">
                            <div class="col-md-8">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="bi bi-search text-muted"></i>
                                    </span>
                                    <input type="text" name="search" class="form-control border-start-0" 
                                           placeholder="Search notices..." value="{{ request('search') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <select name="type" class="form-select" onchange="this.form.submit()">
                                    <option value="">All Categories</option>
                                    <option value="general" {{ request('type') == 'general' ? 'selected' : '' }}>General</option>
                                    <option value="event" {{ request('type') == 'event' ? 'selected' : '' }}>Events</option>
                                    <option value="exam" {{ request('type') == 'exam' ? 'selected' : '' }}>Exams</option>
                                    <option value="course_material" {{ request('type') == 'course_material' ? 'selected' : '' }}>Course Materials</option>
                                    <option value="announcement" {{ request('type') == 'announcement' ? 'selected' : '' }}>Announcements</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notices Grid -->
        <div class="row g-4">
            @forelse($notices as $notice)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm transition-all hover:shadow-lg">
                        @if($notice->image_path)
                            <div class="notice-image-container" style="height: 200px; overflow: hidden;">
                                <img src="{{ asset('storage/' . $notice->image_path) }}" 
                                     class="card-img-top h-100 w-100 object-cover" 
                                     alt="{{ $notice->title }}"
                                     style="object-fit: cover; transition: transform 0.3s ease;">
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="badge rounded-pill px-3 py-2 mb-2" 
                                      style="background: {{ $notice->type == 'event' ? 'rgba(220, 53, 69, 0.1)' : ($notice->type == 'exam' ? 'rgba(255, 193, 7, 0.1)' : 'rgba(13, 110, 253, 0.1)') }}; 
                                             color: {{ $notice->type == 'event' ? '#dc3545' : ($notice->type == 'exam' ? '#ffc107' : '#0d6efd') }};">
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
                                <small class="text-muted">
                                    <i class="bi bi-calendar3 me-1"></i> {{ $notice->notice_date->format('M d, Y') }}
                                </small>
                            </div>
                            
                            <h5 class="card-title fw-bold mb-3">{{ $notice->title }}</h5>
                            <p class="card-text text-muted mb-4">
                                {{ \Illuminate\Support\Str::limit($notice->description, 120) }}
                            </p>
                            
                            @if($notice->event_date)
                                <div class="d-flex align-items-center text-muted mb-3">
                                    <i class="bi bi-clock-history me-2"></i>
                                    <span>{{ $notice->event_date->format('F j, Y \a\t g:i A') }}</span>
                                </div>
                            @endif
                            
                            @if($notice->location)
                                <div class="d-flex align-items-center text-muted mb-3">
                                    <i class="bi bi-geo-alt me-2"></i>
                                    <span>{{ $notice->location }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="card-footer bg-transparent border-top-0 pt-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('notices.show', $notice) }}" 
                                   class="btn btn-outline-primary btn-sm rounded-pill px-4">
                                    Read More <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                                @if($notice->file_path)
                                    <a href="{{ route('notices.download', $notice) }}" 
                                       class="btn btn-link text-decoration-none" 
                                       data-bs-toggle="tooltip" 
                                       title="Download {{ $notice->file_name }}">
                                        <i class="bi bi-download fs-5 text-muted"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="bi bi-inbox fs-1 text-muted"></i>
                        </div>
                        <h4 class="text-muted mb-3">No notices found</h4>
                        <p class="text-muted">Check back later for updates or try a different search term.</p>
                        <a href="{{ route('notices.index') }}" class="btn btn-primary mt-2">
                            <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Filters
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($notices->hasPages())
            <div class="d-flex justify-content-center mt-5">
                <nav aria-label="Notices pagination">
                    {{ $notices->withQueryString()->links('vendor.pagination.custom') }}
                </nav>
            </div>
        @endif
    </div>
</div>

<style>
    .notice-board {
        background-color: #f8f9fa;
    }
    
    .card {
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.05);
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    .card-title {
        font-size: 1.1rem;
        color: #2c3e50;
    }
    
    .badge i {
        font-size: 0.8em;
    }
    
    .pagination .page-link {
        color: #1A5D3B;
        border: 1px solid #dee2e6;
        margin: 0 2px;
        border-radius: 6px !important;
    }
    
    .page-item.active .page-link {
        background-color: #1A5D3B;
        border-color: #1A5D3B;
    }
    
    .page-item.disabled .page-link {
        color: #6c757d;
    }
    
    .btn-outline-primary {
        --bs-btn-color: #1A5D3B;
        --bs-btn-border-color: #1A5D3B;
        --bs-btn-hover-bg: #1A5D3B;
        --bs-btn-hover-border-color: #1A5D3B;
        --bs-btn-active-bg: #1A5D3B;
        --bs-btn-active-border-color: #1A5D3B;
    }
    
    .notice-image-container {
        position: relative;
        overflow: hidden;
    }
    
    .notice-image-container::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 100%;
        background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,0.1) 100%);
        pointer-events: none;
    }
    
    .card:hover .notice-image-container img {
        transform: scale(1.05);
    }
    
    .divider {
        height: 4px;
        width: 80px;
        background: linear-gradient(90deg, #1A5D3B, #28a745);
        margin: 15px auto 0;
        border-radius: 2px;
    }

    main{
        margin-top: 60px;
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
    });
</script>
@endpush
@endsection