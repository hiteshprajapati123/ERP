@php
    use Illuminate\Support\Facades\Storage;
    $cardClasses = ['card', 'notice-card', 'border-0', 'shadow-sm', 'mb-4'];
    
    if ($notice->is_pinned) {
        $cardClasses[] = 'pinned';
    }
    
    if ($notice->is_important) {
        $cardClasses[] = 'important';
    }
    
    $iconMap = [
        'pdf' => ['fas fa-file-pdf text-danger', 'PDF'],
        'doc' => ['fas fa-file-word text-primary', 'DOC'],
        'docx' => ['fas fa-file-word text-primary', 'DOCX'],
        'xls' => ['fas fa-file-excel text-success', 'XLS'],
        'xlsx' => ['fas fa-file-excel text-success', 'XLSX'],
        'jpg' => ['fas fa-file-image text-info', 'JPG'],
        'jpeg' => ['fas fa-file-image text-info', 'JPEG'],
        'png' => ['fas fa-file-image text-info', 'PNG'],
        'default' => ['fas fa-file-alt text-secondary', 'FILE']
    ];
    
    $fileExt = $notice->file_path ? strtolower(pathinfo($notice->file_path, PATHINFO_EXTENSION)) : null;
    $fileIcon = $fileExt && isset($iconMap[$fileExt]) ? $iconMap[$fileExt] : $iconMap['default'];
    
    $hasFile = !empty($notice->file_path);
    $hasImage = $notice->image_path && in_array(pathinfo($notice->image_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']);
@endphp

<div class="{{ implode(' ', $cardClasses) }}">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-start">
            <h6 class="notice-title mb-0">
                <a href="{{ route('user.notices.show', $notice->slug) }}" class="text-decoration-none">
                    {{ $notice->title }}
                </a>
            </h6>
            <div class="d-flex gap-2">
                @if($notice->noticeCategory)
                    <span class="badge badge-type" style="background-color: #4e73df; color: white;">
                        {{ $notice->noticeCategory->name }}
                    </span>
                @else
                    <span class="badge badge-type" style="background-color: #6c757d; color: white;">
                        No Category
                    </span>
                @endif
                @if($hasFile)
                    <span class="badge bg-light text-dark">
                        <i class="{{ $fileIcon[0] }} me-1"></i> {{ $fileIcon[1] }}
                    </span>
                @endif
            </div>
        </div>
        
        <div class="notice-date mb-2">
            <i class="far fa-calendar-alt me-1"></i>
            {{ $notice->publish_date->format('F j, Y') }}
            
            @if($notice->is_important)
                <span class="badge bg-danger ms-2">Important</span>
            @endif
            
            @if($notice->expiry_date && $notice->expiry_date->isPast())
                <span class="badge bg-secondary ms-2">Expired</span>
            @endif
        </div>
        
        @if($notice->description)
            <p class="notice-content mb-3">
                {{ Str::limit($notice->description, 150) }}
            </p>
        @endif
        
        <div class="d-flex gap-2">
            @if($hasFile)
                <a href="{{ route('user.notices.download', $notice->id) }}" class="btn btn-sm btn-outline-primary flex-grow-1">
                    <i class="fas fa-download me-1"></i> Download
                </a>
            @endif
            
            <a href="{{ route('user.notices.show', $notice->slug) }}" class="btn btn-sm btn-outline-secondary flex-grow-1">
                <i class="fas fa-eye me-1"></i> View Details
            </a>
        </div>
    </div>
</div>
