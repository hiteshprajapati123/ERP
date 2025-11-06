<?php

namespace App\Http\Controllers;

use App\Models\ExamResult;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExamResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all results for the authenticated user, ordered by date (newest first)
        $results = ExamResult::where('user_id', Auth::id())
            ->orderBy('date', 'desc')
            ->paginate(5) // Show 5 results per page
            ->appends(request()->query()); // Keep any query parameters when paginating

        // Transform the results to include the calculated percentage
        $results->getCollection()->transform(function ($result) {
            return [
                'id' => $result->id,
                'exam_name' => $result->exam_name,
                'date' => $result->date,
                'obtained_marks' => $result->obtained_marks,
                'total_marks' => $result->total_marks,
                'grade' => $result->grade,
                'percentage' => $result->percentage,
            ];
        });

        return view('user-dashboard.side-pages.exam-results', compact('results'));
    }

    /**
     * Display the specified resource.
     */
    public function show(ExamResult $examResult)
    {
        // Only allow viewing if the result belongs to the authenticated user
        if ($examResult->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return response()->json([
            'success' => true,
            'data' => $examResult
        ]);
    }

    /**
     * Get exam results summary for the authenticated user
     */
    public function summary()
    {
        $results = ExamResult::select('exam_name', DB::raw('AVG(marks) as average_marks'))
            ->where('user_id', Auth::id())
            ->groupBy('exam_name')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $results
        ]);
    }
}