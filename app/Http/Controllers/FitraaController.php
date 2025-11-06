<?php

namespace App\Http\Controllers;

use App\Models\Fitraa;
use Illuminate\Http\Request;

class FitraaController extends Controller
{
    /**
     * Display the Fitraa page.
     */
    public function index()
    {
        $fitraa = Fitraa::where('is_active', true)
            ->orWhere('is_active', 1)
            ->firstOrFail();
            
        return view('donation.fitraa', compact('fitraa'));
    }

    /**
     * Show the form for editing the Fitraa content.
     */
    public function edit()
    {
        $fitraa = Fitraa::firstOrNew();
        return view('admin.fitraa.edit', compact('fitraa'));
    }

    /**
     * Update the Fitraa content.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'hero_title' => 'required|string|max:255',
            'hero_quote' => 'required|string',
            'what_is_title' => 'required|string|max:255',
            'what_is_content' => 'required|string',
            'donation_title' => 'required|string|max:255',
            'donation_description' => 'required|string',
            'donation_note' => 'required|string',
            'is_active' => 'boolean',
        ]);

        $fitraa = Fitraa::updateOrCreate(
            ['id' => $id],
            $validated
        );

        return redirect()->route('admin.fitraa.edit')
            ->with('success', 'Fitraa content updated successfully');
    }
}
