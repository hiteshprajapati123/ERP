<?php

namespace App\Http\Controllers;

use App\Models\Paper;
use Illuminate\Http\Request;

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
}
