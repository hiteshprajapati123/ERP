@php
    $currentPage = $paginator->currentPage();
    $lastPage = $paginator->lastPage();
    $window = 1; // Number of pages to show around current page
    
    $startPage = max($currentPage - $window, 1);
    $endPage = min($currentPage + $window, $lastPage);
    
    if ($startPage === 1) {
        $endPage = min($lastPage, 1 + ($window * 2));
    }
    if ($endPage === $lastPage) {
        $startPage = max(1, $lastPage - ($window * 2));
    }
@endphp

@if ($paginator->hasPages())
<div class="pagination-wrapper">
    <nav aria-label="Page navigation" class="pagination-nav">
        <ul class="pagination-list">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="pagination-item disabled" aria-disabled="true">
                    <span class="pagination-link">
                        <i class="fas fa-chevron-left"></i>
                    </span>
                </li>
            @else
                <li class="pagination-item">
                    <a href="{{ $paginator->previousPageUrl() }}" 
                       class="pagination-link" 
                       data-page="{{ $paginator->currentPage() - 1 }}"
                       aria-label="Previous">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
            @endif

            {{-- First Page --}}
            @if ($startPage > 1)
                <li class="pagination-item">
                    <a href="{{ $paginator->url(1) }}" 
                       class="pagination-link" 
                       data-page="1">1</a>
                </li>
                @if ($startPage > 2)
                    <li class="pagination-item disabled">
                        <span class="pagination-ellipsis">...</span>
                    </li>
                @endif
            @endif

            {{-- Page Numbers --}}
            @for ($i = $startPage; $i <= $endPage; $i++)
                @if ($i == $currentPage)
                    <li class="pagination-item active">
                        <span class="pagination-link current">{{ $i }}</span>
                    </li>
                @else
                    <li class="pagination-item">
                        <a href="{{ $paginator->url($i) }}" 
                           class="pagination-link" 
                           data-page="{{ $i }}">{{ $i }}</a>
                    </li>
                @endif
            @endfor

            {{-- Last Page --}}
            @if ($endPage < $lastPage)
                @if ($endPage < $lastPage - 1)
                    <li class="pagination-item disabled">
                        <span class="pagination-ellipsis">...</span>
                    </li>
                @endif
                <li class="pagination-item">
                    <a href="{{ $paginator->url($lastPage) }}" 
                       class="pagination-link" 
                       data-page="{{ $lastPage }}">{{ $lastPage }}</a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="pagination-item">
                    <a href="{{ $paginator->nextPageUrl() }}" 
                       class="pagination-link" 
                       data-page="{{ $paginator->currentPage() + 1 }}"
                       aria-label="Next">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            @else
                <li class="pagination-item disabled" aria-disabled="true">
                    <span class="pagination-link">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
</div>

<style>
.pagination-wrapper {
    margin: 2rem 0;
    width: 100%;
    display: flex;
    justify-content: center;
    overflow: hidden;
}

.pagination-nav {
    display: inline-block;
    border-radius: 8px;
    background: #fff;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    padding: 4px;
}

.pagination-list {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
    align-items: center;
    gap: 4px;
}

.pagination-item {
    margin: 0;
    padding: 0;
}

.pagination-link, 
.pagination-ellipsis {
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 40px;
    height: 40px;
    padding: 0 12px;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    color: #4B5563;
    text-decoration: none;
    transition: all 0.2s ease;
    border: 1px solid transparent;
}

.pagination-link:hover:not(.current) {
    background-color: #f3f4f6;
    color: #1F2937;
}

.pagination-link.current {
    background-color: #1A5D3B;
    color: white;
    border-color: #1A5D3B;
}

.pagination-link[rel="prev"],
.pagination-link[rel="next"] {
    background-color: #f9fafb;
}

.pagination-link[rel="prev"]:hover,
.pagination-link[rel="next"]:hover {
    background-color: #f3f4f6;
}

.pagination-ellipsis {
    color: #9CA3AF;
    pointer-events: none;
}

.pagination-item.disabled .pagination-link {
    color: #D1D5DB;
    background-color: #f9fafb;
    cursor: not-allowed;
    opacity: 0.7;
}

/* Responsive adjustments */
@media (max-width: 640px) {
    .pagination-link {
        min-width: 36px;
        height: 36px;
        padding: 0 8px;
        font-size: 13px;
    }
    
    .pagination-list {
        gap: 2px;
    }
}
</style>
@endif