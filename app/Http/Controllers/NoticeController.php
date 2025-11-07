<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function index()
    {
        $search = request('search');
        $categoryId = request('category');

        $notices = Notice::with('category')
            ->published()
            ->when($search, function($query) use ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->when($categoryId, function($query) use ($categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->orderBy('notice_date', 'desc')
            ->paginate(6)
            ->withQueryString();

        $categories = \App\Models\NoticeCategory::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get(['id','name']);

        return view('notices.index', compact('notices', 'categories'));
    }

    public function show(Notice $notice)
    {
        if (!$notice->is_published) {
            abort(404);
        }

        return view('notices.show', compact('notice'));
    }

    public function download(Notice $notice)
    {
        if (!$notice->is_published || !$notice->file_path) {
            abort(404);
        }

        $fullPath = \Storage::disk('private')->path($notice->file_path);
        if (!file_exists($fullPath)) {
            abort(404);
        }

        return response()->download($fullPath, $notice->file_name);
    }

    public function image(Notice $notice)
    {
        if (!$notice->is_published || !$notice->image_path) {
            abort(404);
        }

        $fullPath = \Storage::disk('private')->path($notice->image_path);
        if (!file_exists($fullPath)) {
            abort(404);
        }

        return response()->file($fullPath);
    }
}