@extends('layouts.user-dashboard')

@section('title', 'Notices')

@push('styles')
<style>
    .notice-card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        border-left: 4px solid #4e73df;
        margin-bottom: 1rem;
    }
    .notice-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
    }
    .notice-date {
        font-size: 0.85rem;
        color: #6c757d;
    }
    .notice-title {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }
    .notice-content {
        color: #6c757d;
        font-size: 0.95rem;
    }
    .badge-notice {
        background-color: #e9ecef;
        color: #495057;
        font-weight: 500;
        font-size: 0.75rem;
    }
    .badge-type {
        text-transform: capitalize;
    }
    .pinned {
        border-left-color: #ffc107;
    }
    .important {
        border-left-color: #dc3545;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-0 px-md-3">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-center py-3">
                    <h5 class="mb-2 mb-md-0">Notice Board</h5>
                    <div class="mt-2 mt-md-0">
                        <form action="{{ route('user.notices.index') }}" method="GET" id="noticeFilterForm" class="d-flex">
                            <select name="category" class="form-select form-select-sm me-2" onchange="updateFilter(this)">
                                <option value="">All Categories</option>
                                @foreach($noticeCategories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                    
                    @push('scripts')
                    <script>
                        function updateFilter(select) {
                            const form = document.getElementById('noticeFilterForm');
                            const url = new URL(form.action);
                            
                            // Remove the category parameter if 'All Categories' is selected
                            if (select.value === '') {
                                url.searchParams.delete('category');
                                window.location.href = url.toString();
                                return;
                            }
                            
                            // Otherwise, submit the form with the selected category
                            form.submit();
                        }
                    </script>
                    @endpush
                </div>
                <div class="card-body">
                    @if($pinnedNotices->count() > 0)
                        <h6 class="mb-3"><i class="fas fa-thumbtack text-warning me-2"></i>Pinned Notices</h6>
                        @foreach($pinnedNotices as $notice)
                            @include('user-dashboard.partials.notice-item', ['notice' => $notice])
                        @endforeach
                        <hr class="my-4">
                    @endif

                    @if($notices->count() > 0)
                        <div class="notices-list">
                            @foreach($notices as $notice)
                                @include('user-dashboard.partials.notice-item', ['notice' => $notice])
                            @endforeach
                        </div>

                        <div class="mt-4">
                            {{ $notices->appends(request()->query())->links('vendor.pagination.custom') }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No notices found.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection