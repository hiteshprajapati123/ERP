<?php

namespace App\Http\Controllers;

use App\Models\Fitraa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FitraaController extends Controller
{
    /**
     * Display the Fitraa page.
     */
    public function index()
    {
        $fitraa = Fitraa::first();
        
        if (!$fitraa || !$fitraa->is_active) {
            return view('donation.fitraa', ['fitraa' => null]);
        }
            
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

    /**
     * Serve private files for Fitraa
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
