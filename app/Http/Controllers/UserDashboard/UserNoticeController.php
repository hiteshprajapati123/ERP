<?php

namespace App\Http\Controllers\UserDashboard;

use App\Http\Controllers\Controller;
use App\Models\NoticeCategory;
use App\Models\UserNotice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// Standard Laravel view rendering

class UserNoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get all active notice categories for the filter
        $noticeCategories = NoticeCategory::where('is_active', true)->orderBy('name')->get();
        
        // Base query for all notices
        $baseQuery = UserNotice::published()
            ->with(['author', 'noticeCategory'])
            ->latest('publish_date');

        // Handle category filter if provided
        $categoryFilter = $request->input('category');
        $hasCategoryFilter = $request->filled('category'); // Only true if category is not empty

        // Get pinned notices (filtered by category if needed)
        $pinnedNotices = (clone $baseQuery)
            ->pinned()
            ->when($hasCategoryFilter, function($query) use ($categoryFilter) {
                return $query->where('notice_category_id', $categoryFilter);
            })
            ->take(3)
            ->get();

        // Get regular notices (filtered by category if needed, and exclude pinned)
        $noticesQuery = (clone $baseQuery)
            ->whereNotIn('id', $pinnedNotices->pluck('id'))
            ->where(function($q) {
                $q->where('is_pinned', false)
                  ->orWhereNull('is_pinned');
            });

        // Apply category filter to regular notices if needed
        if ($hasCategoryFilter) {
            $noticesQuery->where('notice_category_id', $categoryFilter);
        }

        // Get paginated results
        $notices = $noticesQuery->paginate(2)->withQueryString();

        return view('user-dashboard.side-pages.notice', [
            'pinnedNotices' => $pinnedNotices,
            'notices' => $notices,
            'noticeCategories' => $noticeCategories,
            'filters' => $request->only(['category']),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $notice = UserNotice::where('slug', $slug)
            ->published()
            ->with(['author', 'noticeCategory'])
            ->firstOrFail();

        // Get related notices (same category, excluding current)
        $relatedNotices = UserNotice::published()
            ->where('notice_category_id', $notice->notice_category_id)
            ->where('id', '!=', $notice->id)
            ->latest('publish_date')
            ->take(3)
            ->get();

        return view('user-dashboard.notices.show', [
            'notice' => $notice,
            'relatedNotices' => $relatedNotices,
        ]);
    }

    /**
     * Download the notice file.
     */
    public function download($id)
    {
        $notice = UserNotice::published()->findOrFail($id);

        if (!$notice->file_path || !file_exists(storage_path('app/' . $notice->file_path))) {
            abort(404);
        }

        return response()->download(storage_path('app/' . $notice->file_path), $notice->file_name);
    }

    /**
     * Serve private images securely
     */
    public function serveImage($path)
    {
        // Ensure the path starts with private/UserNotice/Image/
        if (!str_starts_with($path, 'private/UserNotice/Image/')) {
            abort(403, 'Unauthorized access to image');
        }

        $fullPath = storage_path('app/' . $path);

        if (!file_exists($fullPath)) {
            abort(404, 'Image not found');
        }

        $mimeType = mime_content_type($fullPath);
        if (!str_starts_with($mimeType, 'image/')) {
            abort(403, 'Not an image file');
        }

        return response()->file($fullPath);
    }
}
