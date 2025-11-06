<?php

namespace App\Http\Controllers;

use App\Models\Zakat;
use Illuminate\Http\Request;

class ZakatController extends Controller
{
    /**
     * Display the Zakat page.
     */
    public function index()
    {
        $zakat = Zakat::where('is_active', true)
            ->orWhere('is_active', 1)
            ->firstOrFail();
            
        return view('donation.zakat', compact('zakat'));
    }

    /**
     * Show the form for editing the Zakat content.
     */
    public function edit()
    {
        $zakat = Zakat::firstOrNew();
        return view('admin.zakat.edit', compact('zakat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Zakat $zakat)
    {
        $validated = $request->validate([
            'hero_title' => 'required|string|max:255',
            'hero_quote' => 'required|string',
            'what_is_title' => 'required|string|max:255',
            'what_is_content' => 'required|string',
            'donation_title' => 'required|string|max:255',
            'donation_description' => 'required|string',
            'donation_note' => 'required|string',
            'nisab_gold' => 'required|numeric|min:0',
            'nisab_silver' => 'required|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        // Handle file uploads if present
        if ($request->hasFile('hero_image')) {
            $validated['hero_image'] = $request->file('hero_image')->store('zakat', 'public');
        }

        if ($request->hasFile('what_is_image')) {
            $validated['what_is_image'] = $request->file('what_is_image')->store('zakat', 'public');
        }

        if ($request->hasFile('qr_code_image')) {
            $validated['qr_code_image'] = $request->file('qr_code_image')->store('zakat', 'public');
        }

        // Handle key points JSON
        if ($request->has('key_points')) {
            $validated['key_points'] = json_encode($request->key_points);
        }

        $zakat->fill($validated);
        $zakat->save();

        return redirect()->route('admin.zakat.edit')
            ->with('success', 'Zakat content updated successfully.');
    }
}
