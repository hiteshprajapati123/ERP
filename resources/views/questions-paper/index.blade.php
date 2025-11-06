@extends('layouts.app')

@section('title', 'Question Papers')

@section('content')
<div class="container py-5 mt-5">
    <!-- Page Header -->
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold text-primary mb-3">Question Papers</h1>
        <p class="lead text-muted">Access and download previous year question papers for practice</p>
    </div>

    <!-- Papers Grid -->
    <div class="row g-4">
        @foreach($papers as $index => $paper)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                <div class="card-header bg-white border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-primary bg-opacity-10 text-primary">Class {{ $paper->class }}</span>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-link text-muted p-0" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#viewPaper{{ $paper->id }}"><i class="bi bi-eye me-2"></i>View</a></li>
                                <li><a class="dropdown-item" href="{{ asset('storage/' . $paper->file_path) }}" download><i class="bi bi-download me-2"></i>Download</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title mb-2">{{ $paper->title }}</h5>
                    <p class="text-muted small mb-3">{{ $paper->term }} - {{ $paper->subject }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-light text-dark"><i class="bi bi-file-pdf text-danger me-1"></i> PDF</span>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 pt-0">
                    <button class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#viewPaper{{ $paper->id }}">
                        <i class="bi bi-eye me-2"></i>View Paper
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- View Paper Modals -->
@foreach($papers as $paper)
<div class="modal fade" id="viewPaper{{ $paper->id }}" tabindex="-1" aria-labelledby="viewPaper{{ $paper->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewPaper{{ $paper->id }}Label">{{ $paper->title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="ratio ratio-16x9 mb-3">
                    <iframe src="{{ asset('storage/' . $paper->file_path) }}" class="rounded" style="border: 1px solid #dee2e6;"></iframe>
                </div>
                <p class="text-muted small">Scroll to view the full document</p>
            </div>
            <div class="modal-footer">
                <a href="{{ asset('storage/' . $paper->file_path) }}" class="btn btn-outline-secondary" download>
                    <i class="bi bi-download me-2"></i>Download
                </a>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach

@push('styles')
<style>
    .hover-shadow {
        transition: all 0.3s ease;
    }
    
    .hover-shadow:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1) !important;
    }
    
    .card {
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .card-header {
        padding: 1rem 1.25rem;
    }
    
    .card-body {
        padding: 1.5rem;
    }
    
    .card-footer {
        background-color: #f8f9fa;
        padding: 1rem 1.5rem;
    }
    
    .badge {
        font-weight: 500;
        padding: 0.4em 0.8em;
        font-size: 0.8em;
    }
    
    .btn-outline-primary {
        border-width: 1.5px;
    }
    
    @media (max-width: 767.98px) {
        .card {
            margin-bottom: 1.5rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endpush
@endsection