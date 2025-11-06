<?php

namespace App\Http\Controllers\UserDashboard;

use App\Http\Controllers\Controller;
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
        // Get all notice types for the filter
        $noticeTypes = UserNotice::getNoticeTypes();
        
        // Base query for all notices
        $baseQuery = UserNotice::published()
            ->with('author')
            ->latest('publish_date');

        // Handle type filter if provided
        $typeFilter = $request->input('type');
        $hasTypeFilter = $request->filled('type'); // Only true if type is not empty

        // Get pinned notices (filtered by type if needed)
        $pinnedNotices = (clone $baseQuery)
            ->pinned()
            ->when($hasTypeFilter, function($query) use ($typeFilter) {
                return $query->where('type', $typeFilter);
            })
            ->take(3)
            ->get();

        // Get regular notices (filtered by type if needed, and exclude pinned)
        $noticesQuery = (clone $baseQuery)
            ->whereNotIn('id', $pinnedNotices->pluck('id'))
            ->where(function($q) {
                $q->where('is_pinned', false)
                  ->orWhereNull('is_pinned');
            });

        // Apply type filter to regular notices if needed
        if ($hasTypeFilter) {
            $noticesQuery->where('type', $typeFilter);
        }

        // Get paginated results
        $notices = $noticesQuery->paginate(10)->withQueryString();

        // Get all notice types for the filter
        $noticeTypes = UserNotice::getNoticeTypes();

        return view('user-dashboard.side-pages.notice', [
            'pinnedNotices' => $pinnedNotices,
            'notices' => $notices,
            'noticeTypes' => $noticeTypes,
            'filters' => $request->only(['type']),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $notice = UserNotice::where('slug', $slug)
            ->published()
            ->with('author')
            ->firstOrFail();

        // Get related notices (same type, excluding current)
        $relatedNotices = UserNotice::published()
            ->where('type', $notice->type)
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

        if (!$notice->file_path || !file_exists(storage_path('app/public/' . $notice->file_path))) {
            abort(404);
        }

        return response()->download(storage_path('app/public/' . $notice->file_path), $notice->file_name);
    }
}
