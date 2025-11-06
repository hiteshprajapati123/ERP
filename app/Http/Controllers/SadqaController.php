<?php

namespace App\Http\Controllers;

use App\Models\Sadqa;
use Illuminate\Http\Request;

class SadqaController extends Controller
{
    /**
     * Display the Sadqa page.
     */
    public function index()
    {
        $sadqa = Sadqa::where('is_active', true)
            ->orWhere('is_active', 1)
            ->firstOrFail();
            
        return view('donation.sadqa', compact('sadqa'));
    }

    /**
     * Show the form for editing the Sadqa content.
     */
    public function edit()
    {
        $sadqa = Sadqa::firstOrNew();
        return view('admin.sadqa.edit', compact('sadqa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sadqa $sadqa)
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

        // Handle file uploads if present
        if ($request->hasFile('hero_image')) {
            $validated['hero_image'] = $request->file('hero_image')->store('sadqa', 'public');
        }

        if ($request->hasFile('what_is_image')) {
            $validated['what_is_image'] = $request->file('what_is_image')->store('sadqa', 'public');
        }

        if ($request->hasFile('qr_code_image')) {
            $validated['qr_code_image'] = $request->file('qr_code_image')->store('sadqa', 'public');
        }

        // Handle benefits JSON
        if ($request->has('benefits')) {
            $validated['benefits'] = json_encode($request->benefits);
        }

        $sadqa->fill($validated);
        $sadqa->save();

        return redirect()->route('admin.sadqa.edit')
            ->with('success', 'Sadqa content updated successfully.');
    }
}
