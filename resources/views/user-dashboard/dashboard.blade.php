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
            <span class="fw-medium">{{ now()->format('l, F j, Y') }}</span>
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
                                <span class="badge bg-danger text-white small px-2 py-1" style="background-color: #dc3545 !important; font-weight: 500; letter-spacing: 0.5px; white-space: nowrap;">
                                    <i class="fas fa-exclamation-triangle me-1"></i>Overdue Soon
                                </span>
                            </div>
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
                        @if($stats['latest_exam'])
                            <span class="badge bg-primary bg-opacity-10 text-primary small">
                                {{ \Carbon\Carbon::parse($stats['latest_exam']->created_at)->diffForHumans() }}
                            </span>
                        @endif
                    </div>
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

    <!-- Recent Activity -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="d-flex justify-content-between align-items-center p-4 border-bottom">
                <div>
                    <h5 class="mb-0 fw-bold">Recent Activity</h5>
                    <p class="text-muted small mb-0">Your latest actions and updates</p>
                </div>
                <button id="refresh-activities" class="btn btn-sm btn-light rounded-circle" title="Refresh">
                    <i class="fas fa-sync-alt"></i>
                </button>
            </div>
            
            <div id="activities-container" class="activity-feed">
                <!-- Activities will be loaded here via AJAX -->
                <div class="text-center py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2 text-muted">Loading activities...</p>
                </div>
            </div>
            
            <div class="text-center p-3 bg-light">
                <a href="#" id="load-more-activities" class="text-primary text-decoration-none small fw-medium" data-page="1">
                    <i class="fas fa-arrow-down me-1"></i> Load More Activities
                </a>
            </div>
        </div>
    </div>
</div>

<style>
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