<?php

namespace App\Http\Controllers;

use App\Models\Zakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ZakatController extends Controller
{
    /**
     * Display the Zakat page.
     */
    public function index()
    {
       $zakat = Zakat::first();
        
        if (!$zakat || !$zakat->is_active) {
            return view('donation.zakat', ['zakat' => null]);
        }
            
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

    /**
     * Serve private files for Zakat
     */
    public function serveFile($path = null)
    {
        try {
            // Ensure the file exists in the private storage
            if (!Storage::disk('private')->exists($path)) {
                abort(404);
            }

            // Get the file
            $file = Storage::disk('private')->get($path);
            $mimeType = Storage::disk('private')->mimeType($path);
            
            // Return the file with appropriate headers
            return response($file, 200)
                ->header('Content-Type', $mimeType);
                
        } catch (\Exception $e) {
            abort(404);
        }
    }
}
