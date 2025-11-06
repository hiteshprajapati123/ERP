@extends('layouts.user-dashboard')

@section('title', 'Exam Results')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Exam Results</h4>
            </div>
        </div>
    </div>
    
    @if($results->count() > 0)
        @foreach($results as $index => $result)
            @php
                // Get the percentage from the result
                $percentage = (float) $result['percentage'];
                
                // Determine grade color based on percentage
                $gradeColor = match(true) {
                    $percentage >= 80 => 'success',
                    $percentage >= 60 => 'info',
                    $percentage >= 40 => 'warning',
                    default => 'danger'
                };
                
                // Determine progress bar color
                $progressColor = $gradeColor;
                
                // Format date
                $examDate = \Carbon\Carbon::parse($result['date'])->format('d M, Y');
            @endphp
            
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title mb-0">{{ $result['exam_name'] }}</h5>
                                <span class="badge bg-soft-{{ $gradeColor }} text-{{ $gradeColor }}">
                                    {{ $result['grade'] }}
                                </span>
                            </div>
                            
                            <p class="text-muted mb-3">
                                <i class="far fa-calendar-alt me-1"></i> 
                                {{ $examDate }}
                            </p>
                            
                            <div class="row align-items-center">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avatar-sm">
                                                <div class="avatar-title bg-soft-{{ $progressColor }} text-{{ $progressColor }} rounded-circle fs-18">
                                                    {{ number_format($percentage, 1) }}%
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">Marks Obtained</h6>
                                            <p class="mb-0">
                                                <span class="fw-bold">{{ number_format($result['obtained_marks'], 1) }}</span> out of {{ $result['total_marks'] }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="progress mb-2" style="height: 8px;">
                                        <div class="progress-bar bg-{{ $progressColor }}" role="progressbar" 
                                             style="width: {{ $percentage }}%" 
                                             aria-valuenow="{{ $percentage }}" 
                                             aria-valuemin="0" 
                                             aria-valuemax="100">
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted">Performance</span>
                                        <span class="fw-medium">
                                            @if($percentage >= 80)
                                                Excellent
                                            @elseif($percentage >= 60)
                                                Good
                                            @elseif($percentage >= 40)
                                                Average
                                            @else
                                                Needs Improvement
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            @if($index < $results->count() - 1)
                                <hr class="my-4">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        
        <!-- Pagination -->
        <div class="row mt-4">
            <div class="col-12">
                <nav aria-label="Exam results pagination">
                    {{ $results->links('vendor.pagination.custom') }}
                </nav>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center py-5">
                        <div class="avatar-lg mx-auto mb-4">
                            <div class="avatar-title bg-soft-primary text-primary rounded-circle">
                                <i class="fas fa-clipboard-list" style="font-size: 2rem;"></i>
                            </div>
                        </div>
                        <h5 class="mb-3">No Exam Results Found</h5>
                        <p class="text-muted mb-4">
                            You don't have any exam results available at the moment. 
                            Please check back later or contact your instructor.
                        </p>
                        <a href="{{ route('user.dashboard') }}" class="btn btn-primary">
                            <i class="fas fa-home me-1"></i> Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@push('styles')
<style>
    .card {
        border: none;
        border-radius: 0.75rem;
        transition: all 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    .progress {
        border-radius: 2rem;
        background-color: #f0f4f8;
    }
    
    .progress-bar {
        border-radius: 2rem;
    }
    
    .avatar-title {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
    }
    
    .bg-soft-success {
        background-color: rgba(10, 179, 156, 0.1) !important;
    }
    
    .bg-soft-info {
        background-color: rgba(70, 128, 255, 0.1) !important;
    }
    
    .bg-soft-warning {
        background-color: rgba(244, 196, 25, 0.1) !important;
    }
    
    .bg-soft-danger {
        background-color: rgba(246, 78, 96, 0.1) !important;
    }
</style>
@endpush
@endsection
