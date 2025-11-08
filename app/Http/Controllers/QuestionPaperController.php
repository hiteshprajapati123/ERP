<?php

namespace App\Http\Controllers;

use App\Models\Paper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QuestionPaperController extends Controller
{
    /**
     * Display a listing of the question papers.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $papers = Paper::latest()->get();
        return view('questions-paper.index', compact('papers'));
    }

    public function download(Paper $paper)
    {
        $path = \Storage::disk('private')->path($paper->file_path);
        if (!file_exists($path)) {
            abort(404);
        }

        $fallback = Str::slug($paper->title ?: 'paper') . '.' . pathinfo($path, PATHINFO_EXTENSION);
        $filename = basename($paper->file_path) ?: $fallback;

        return response()->download($path, $filename);
    }
}
