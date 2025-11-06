<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class FeeController extends Controller
{
    /**
     * Display the fees page.
     */
    public function indexPage()
    {
        $fees = auth()->user()->fees()
            ->orderBy('due_date', 'desc')
            ->get();

        $totalFees = $fees->sum('amount');
        $paidFees = $fees->where('status', 'paid')->sum('amount');
        $pendingFees = $fees->where('status', '!=', 'paid')->sum('amount');

        return view('user-dashboard.side-pages.fees', [
            'fees' => $fees,
            'totalFees' => $totalFees,
            'paidFees' => $paidFees,
            'pendingFees' => $pendingFees,
            'balance' => $totalFees - $paidFees
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $fees = $user->fees()
            ->orderBy('due_date', 'desc')
            ->get();

        $totalFees = $fees->sum('amount');
        $paidFees = $fees->where('status', 'paid')->sum('amount');
        $pendingFees = $fees->where('status', '!=', 'paid')->sum('amount');

        return response()->json([
            'fees' => $fees,
            'summary' => [
                'total_fees' => $totalFees,
                'paid_fees' => $paidFees,
                'pending_fees' => $pendingFees,
                'balance' => $totalFees - $paidFees
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'month_year' => 'required|date_format:Y-m',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
            'status' => 'required|in:pending,paid,overdue',
        ]);

        $fee = Fee::create($validated);

        // Log the activity
        if ($fee) {
            UserActivity::create([
                'user_id' => Auth::id(),
                'activity_type' => UserActivity::TYPE_CREATED,
                'description' => 'Created fee record for ' . $fee->user->name . ' - ' . $fee->description,
                'model_type' => UserActivity::MODEL_FEE,
                'model_id' => $fee->id,
                'new_values' => $fee->toArray(),
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }

        return response()->json([
            'message' => 'Fee record created successfully',
            'fee' => $fee
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $fee = Fee::findOrFail($id);
        $oldValues = $fee->toArray();
        
        $validated = $request->validate([
            'month_year' => 'sometimes|required|date_format:Y-m',
            'description' => 'sometimes|required|string|max:255',
            'amount' => 'sometimes|required|numeric|min:0',
            'due_date' => 'sometimes|required|date',
            'status' => 'sometimes|required|in:pending,paid,overdue',
            'paid_date' => 'nullable|date',
            'transaction_id' => 'nullable|string|max:255',
            'payment_details' => 'nullable|string',
        ]);

        $fee->update($validated);

        // Log the activity
        $user = auth()->user();
        $description = 'Fee record updated for ' . $user->name . ' - ' . $fee->description . ' (' . $fee->month_year . ')';
        
        $activity = new \App\Models\UserActivity([
            'user_id' => $user->id,
            'activity_type' => \App\Models\UserActivity::TYPE_UPDATED,
            'description' => $description,
            'model_type' => \App\Models\UserActivity::MODEL_FEE,
            'model_id' => $fee->id,
            'old_values' => $oldValues,
            'new_values' => $fee->toArray(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);
        
        $activity->save();

        return response()->json([
            'message' => 'Fee updated successfully',
            'fee' => $fee,
            'activity_logged' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
