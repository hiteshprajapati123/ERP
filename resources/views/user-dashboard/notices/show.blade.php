@extends('layouts.user-dashboard')

@php
    use Illuminate\Support\Facades\Storage;
    use App\Helpers\FileHelper;
    
    // Get all notices that have files
    $recentFiles = \App\Models\UserNotice::published()
        ->whereNotNull('file_path')
        ->where('id', '!=', $notice->id)
        ->latest('publish_date')
        ->take(5)
        ->get()
        ->map(function($fileNotice) {
            $fileNotice->file_info = FileHelper::getFileInfo($fileNotice->file_path, $fileNotice->file_size);
            return $fileNotice;
        });
@endphp

@section('title', $notice->title)

@push('styles')
<style>
    :root {
        --primary-color: #4e73df;
        --secondary-color: #6c757d;
        --success-color: #1cc88a;
        --danger-color: #e74a3b;
        --warning-color: #f6c23e;
        --light-bg: #f8f9fc;
    }
    
    .notice-header {
        border-bottom: 1px solid #e9ecef;
        padding-bottom: 1.5rem;
        margin-bottom: 2rem;
        position: relative;
    }
    
    .notice-title {
        font-size: 2rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 0.75rem;
        line-height: 1.3;
    }
    
    .notice-meta {
        color: #6c757d;
        font-size: 0.95rem;
        margin-bottom: 1.25rem;
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        align-items: center;
    }
    
    .notice-content {
        line-height: 1.8;
        color: #4a4f55;
        font-size: 1.05rem;
    }
    
    .notice-content img {
        max-width: 100%;
        height: auto;
        border-radius: 0.5rem;
        margin: 1.5rem 0;
        box-shadow: 0 0.15rem 0.5rem rgba(0, 0, 0, 0.1);
    }
    
    .notice-content p {
        margin-bottom: 1.5rem;
    }
    
    .notice-image-container {
        position: relative;
        margin: 2rem 0;
        border-radius: 0.5rem;
        overflow: hidden;
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
        background-color: #fff;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .notice-image {
        width: 100%;
        height: auto;
        display: block;
    }
    
    .file-card {
        background: #fff;
        border: 1px solid rgba(0, 0, 0, 0.05);
        border-radius: 0.5rem;
        overflow: hidden;
        margin: 2rem 0;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }
    
    .file-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
    }
    
    .file-header {
        padding: 1.25rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        display: flex;
        align-items: center;
        background-color: var(--light-bg);
    }
    
    .file-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.375rem;
        margin-right: 1rem;
        flex-shrink: 0;
    }
    
    .file-info {
        flex-grow: 1;
        min-width: 0;
    }
    
    .file-name {
        font-weight: 600;
        margin-bottom: 0.25rem;
        color: #2c3e50;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .file-meta {
        font-size: 0.8rem;
        color: #6c757d;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .file-actions {
        display: flex;
        gap: 0.5rem;
    }
    
    .btn-download {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        font-weight: 500;
        transition: all 0.2s;
        background-color: var(--primary-color);
        color: white;
        border: none;
        text-decoration: none;
    }
    
    .btn-download:hover {
        background-color: #2e59d9;
        color: white;
        transform: translateY(-1px);
    }
    
    .btn-preview {
        background-color: #fff;
        color: var(--primary-color);
        border: 1px solid var(--primary-color);
    }
    
    .btn-preview:hover {
        background-color: #f8f9fc;
        color: var(--primary-color);
    }
    
    .related-notices {
        background: #fff;
        border-radius: 0.5rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }
    
    .related-notice-item {
        padding: 1.25rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.2s;
        display: block;
        color: #4a4f55;
        text-decoration: none;
    }
    
    .related-notice-item:hover {
        background-color: #f8f9fc;
        padding-left: 1.5rem;
    }
    
    .related-notice-title {
        font-weight: 600;
        margin-bottom: 0.25rem;
        color: #2c3e50;
    }
    
    .related-notice-date {
        font-size: 0.8rem;
        color: #6c757d;
    }
    
    .tag {
        display: inline-flex;
        align-items: center;
        padding: 0.35em 0.65em;
        font-size: 0.75em;
        font-weight: 700;
        line-height: 1;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 0.25rem;
    }
    
    .badge-type {
        background-color: var(--primary-color);
    }
    
    .badge-pinned {
        background-color: var(--warning-color);
    }
    
    .badge-important {
        background-color: var(--danger-color);
    }
    
    @media (max-width: 768px) {
        .notice-title {
            font-size: 1.75rem;
        }
        
        .file-header {
            flex-direction: column;
            text-align: center;
        }
        
        .file-icon {
            margin: 0 auto 1rem;
        }
        
        .file-actions {
            margin-top: 1rem;
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <!-- Notice Header -->
                    <div class="notice-header">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start">
                            <div class="mb-3 mb-md-0">
                                <h1 class="notice-title">{{ $notice->title }}</h1>
                                <div class="notice-meta">
                                    <span class="d-flex align-items-center">
                                        <i class="far fa-calendar-alt me-1"></i>
                                        <span>{{ $notice->publish_date->format('F j, Y') }}</span>
                                    </span>
                                    <span class="d-flex align-items-center">
                                        <i class="far fa-user me-1"></i>
                                        <span>{{ $notice->author->name ?? 'Administrator' }}</span>
                                    </span>
                                    <span class="tag badge-type">
                                        <i class="fas fa-tag me-1"></i>
                                        {{ $notice->noticeCategory ? $notice->noticeCategory->name : 'No Category' }}
                                    </span>
                                    @if($notice->is_pinned)
                                        <span class="tag badge-pinned">
                                            <i class="fas fa-thumbtack me-1"></i>
                                            Pinned
                                        </span>
                                    @endif
                                    @if($notice->is_important)
                                        <span class="tag badge-important">
                                            <i class="fas fa-exclamation-circle me-1"></i>
                                            Important
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <a href="{{ route('user.notices.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Back to Notices
                            </a>
                        </div>
                    </div>

                    <!-- Notice Content -->
                    <div class="notice-content">
                        {!! $notice->content !!}
                    </div>

                    <!-- Attached Files -->
                    @if($notice->file_path)
                        <div class="file-card">
                            <div class="file-header">
                                @php
                                    $fileExt = strtolower(pathinfo($notice->file_path, PATHINFO_EXTENSION));
                                    $fileType = 'file';
                                    $icon = 'file';
                                    $iconColor = '#4e73df';
                                    $previewable = false;
                                    
                                    $fileTypes = [
                                        'pdf' => ['icon' => 'file-pdf', 'color' => '#e74a3b', 'preview' => true],
                                        'doc' => ['icon' => 'file-word', 'color' => '#2b579a', 'preview' => false],
                                        'docx' => ['icon' => 'file-word', 'color' => '#2b579a', 'preview' => false],
                                        'xls' => ['icon' => 'file-excel', 'color' => '#1d7044', 'preview' => false],
                                        'xlsx' => ['icon' => 'file-excel', 'color' => '#1d7044', 'preview' => false],
                                        'jpg' => ['icon' => 'file-image', 'color' => '#3498db', 'preview' => true],
                                        'jpeg' => ['icon' => 'file-image', 'color' => '#3498db', 'preview' => true],
                                        'png' => ['icon' => 'file-image', 'color' => '#3498db', 'preview' => true],
                                        'gif' => ['icon' => 'file-image', 'color' => '#3498db', 'preview' => true],
                                        'txt' => ['icon' => 'file-alt', 'color' => '#6c757d', 'preview' => true],
                                        'zip' => ['icon' => 'file-archive', 'color' => '#6f42c1', 'preview' => false],
                                        'rar' => ['icon' => 'file-archive', 'color' => '#6f42c1', 'preview' => false],
                                    ];
                                    
                                    
                                    $fileSize = $notice->file_size ?: Storage::size($notice->file_path);
                                    $fileSizeFormatted = $fileSize ? \App\Helpers\FileHelper::formatFileSize($fileSize) : '';
                                @endphp
                                
                                <div class="file-info">
                                    <div class="file-name">{{ $notice->file_name ?? basename($notice->file_path) }}</div>
                                    <div class="file-meta">
                                        <span>{{ strtoupper($fileExt) }}</span>
                                        <span>•</span>
                                        <span>{{ $fileSizeFormatted }}</span>
                                        <span>•</span>
                                        <span>Uploaded: {{ $notice->created_at->format('M d, Y') }}</span>
                                    </div>
                                </div>
                                
                                <div class="file-actions">
                                    @if($previewable && in_array($fileExt, ['pdf', 'jpg', 'jpeg', 'png', 'gif']))
                                        <a href="#" 
                                           class="btn btn-preview me-2" 
                                           data-bs-toggle="modal" 
                                           data-bs-target="#filePreviewModal"
                                           data-file-url="@if(in_array($fileExt, ['jpg', 'jpeg', 'png', 'gif'])){{ route('user.notices.image', ['path' => $notice->file_path]) }}@else{{ route('user.notices.download', $notice->id) }}@endif"
                                           data-file-type="{{ $fileExt }}">
                                            <i class="fas fa-eye me-1"></i> Preview
                                        </a>
                                    @endif
                                    
                                    <a href="{{ route('user.notices.download', $notice->id) }}" class="btn btn-download">
                                        <i class="fas fa-download me-1"></i> Download
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Share Buttons -->
                    <div class="mt-4 pt-3 border-top">
                        <h6 class="mb-3">Share this notice:</h6>
                        <div class="d-flex gap-2">
                            <a href="whatsapp://send?text={{ urlencode($notice->title . ' - ' . route('user.notices.show', $notice->slug)) }}" 
                               target="_blank" 
                               class="btn btn-sm btn-outline-success">
                                <i class="fab fa-whatsapp me-1"></i> WhatsApp
                            </a>
                            <button onclick="navigator.clipboard.writeText('{{ route('user.notices.show', $notice->slug) }}')" 
                                    class="btn btn-sm btn-outline-secondary ms-auto"
                                    title="Copy link to clipboard">
                                <i class="fas fa-link me-1"></i> Copy Link
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Related Notices -->
            @if($relatedNotices->count() > 0)
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0">
                            <i class="fas fa-link me-2 text-primary"></i>
                            Related Notices
                        </h5>
                    </div>
                    <div class="related-notices">
                        @foreach($relatedNotices as $related)
                            <a href="{{ route('user.notices.show', $related->slug) }}" class="related-notice-item">
                                <h6 class="related-notice-title">
                                    @if($related->is_pinned)
                                        <i class="fas fa-thumbtack text-warning me-1" style="font-size: 0.8em;"></i>
                                    @endif
                                    {{ $related->title }}
                                </h6>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="related-notice-date">
                                        <i class="far fa-calendar-alt me-1"></i>
                                        {{ $related->publish_date->format('M d, Y') }}
                                    </span>
                                    <span class="badge" style="background-color: #4e73df; color: white;">
                                        {{ $related->noticeCategory ? $related->noticeCategory->name : 'No Category' }}
                                    </span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="card-footer bg-white text-center">
                        <a href="{{ route('user.notices.index') }}" class="text-primary">
                            View All Notices <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            @endif
            
            @if(isset($recentFiles) && $recentFiles->isNotEmpty())
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0">
                            <i class="fas fa-paperclip me-2 text-primary"></i>
                            Related Files
                        </h5>
                    </div>
                    <div class="list-group list-group-flush">
                        @foreach($recentFiles as $fileNotice)
                            @php
                                $fileExt = $fileNotice->file_info['extension'] ?? 'file';
                                $icon = 'file';
                                $color = 'secondary';
                                
                                $fileIcons = [
                                    'pdf' => ['icon' => 'file-pdf', 'color' => 'danger'],
                                    'doc' => ['icon' => 'file-word', 'color' => 'primary'],
                                    'docx' => ['icon' => 'file-word', 'color' => 'primary'],
                                    'xls' => ['icon' => 'file-excel', 'color' => 'success'],
                                    'xlsx' => ['icon' => 'file-excel', 'color' => 'success'],
                                    'jpg' => ['icon' => 'file-image', 'color' => 'info'],
                                    'jpeg' => ['icon' => 'file-image', 'color' => 'info'],
                                    'png' => ['icon' => 'file-image', 'color' => 'info'],
                                    'zip' => ['icon' => 'file-archive', 'color' => 'warning'],
                                    'rar' => ['icon' => 'file-archive', 'color' => 'warning'],
                                ];
                                
                                if (array_key_exists($fileExt, $fileIcons)) {
                                    $icon = $fileIcons[$fileExt]['icon'];
                                    $color = $fileIcons[$fileExt]['color'];
                                }
                            @endphp
                            
                            <a href="{{ route('user.notices.download', $fileNotice->id) }}" 
                               class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                               title="{{ basename($fileNotice->file_path) }} ({{ $fileNotice->file_info['formatted_size'] ?? 'Unknown size' }})">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-{{ $icon }} text-{{ $color }} me-2" style="width: 20px;"></i>
                                    <span class="text-truncate" style="max-width: 200px;">
                                        {{ $fileNotice->title }}
                                    </span>
                                </div>
                                <small class="text-muted">{{ strtoupper($fileExt) }}</small>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
            
            <!-- Notice Categories -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-tags me-2 text-primary"></i>
                        Notice Categories
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2">
                        @php
                            $noticeCategories = \App\Models\NoticeCategory::where('is_active', true)->get();
                        @endphp
                        @foreach($noticeCategories as $category)
                            @php
                                $count = \App\Models\UserNotice::published()
                                    ->where('notice_category_id', $category->id)
                                    ->count();
                            @endphp
                            <a href="{{ route('user.notices.index', ['category' => $category->id]) }}" 
                               class="btn btn-sm btn-outline-secondary position-relative">
                                {{ $category->name }}
                                @if($count > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
                                        {{ $count }}
                                        <span class="visually-hidden">notices</span>
                                    </span>
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Additional styles for the preview modal */
    #filePreviewModal .modal-dialog {
        max-width: 95%;
        margin: 1rem auto;
    }
    
    #filePreviewModal .modal-content {
        min-height: 80vh;
    }
    
    #filePreviewModal .modal-body {
        flex: 1 1 auto;
        overflow: hidden;
    }
    
    /* Smooth scrolling for related notices */
    .related-notices {
        max-height: 600px;
        overflow-y: auto;
        scrollbar-width: thin;
    }
    
    .related-notices::-webkit-scrollbar {
        width: 6px;
    }
    
    .related-notices::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    
    .related-notices::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 3px;
    }
    
    .related-notices::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>
@endpush

@endsection
