<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AboutController extends Controller
{
    /**
     * Display the about page.
     */
    public function index()
    {
        $about = About::active()->first();
        
        if (!$about) {
            return view('about.about', ['about' => null]);
        }
        
        return view('about.about', compact('about'));
    }

    /**
     * Update the about page content.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'page_title' => 'required|string|max:255',
            'intro_content' => 'required|string',
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
            'history_content' => 'required|string',
            'what_we_offer' => 'nullable|array',
            'highlights' => 'nullable|array',
            'programs' => 'nullable|array',
            'principal_message' => 'nullable|string',
            'contact_address' => 'required|string',
            'contact_phone' => 'required|string|max:20',
            'contact_email' => 'required|email|max:255',
            'is_active' => 'boolean',
        ]);

        // Convert arrays to JSON
        if (isset($validated['what_we_offer'])) {
            $validated['what_we_offer'] = json_encode($validated['what_we_offer']);
        }
        
        if (isset($validated['highlights'])) {
            $validated['highlights'] = json_encode($validated['highlights']);
        }
        
        if (isset($validated['programs'])) {
            $validated['programs'] = json_encode($validated['programs']);
        }

        $about = About::first();
        
        if ($about) {
            // Update existing about
            $about->update($validated);
        } else {
            // Create new about
            $about = About::create($validated);
        }

        return redirect()->route('admin.about.edit')
            ->with('success', 'About page updated successfully.');
    }
}
