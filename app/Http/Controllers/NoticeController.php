<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function index()
    {
        $search = request('search');
        $type = request('type');

        $notices = Notice::published()
            ->when($search, function($query) use ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->when($type, function($query) use ($type) {
                $query->where('type', $type);
            })
            ->orderBy('notice_date', 'desc')
            ->paginate(6)
            ->withQueryString();

        return view('notices.index', compact('notices'));
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

        return response()->download(storage_path('app/' . $notice->file_path), $notice->file_name);
    }
}