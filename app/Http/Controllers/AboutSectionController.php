<?php

namespace App\Http\Controllers;

use App\Models\AboutSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aboutSections = AboutSection::orderBy('order')->get();
        return view('admin.about.index', compact('aboutSections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.about.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'quote_1_text' => 'required|string|max:255',
            'quote_1_author' => 'required|string|max:100',
            'quote_2_text' => 'required|string|max:255',
            'quote_2_author' => 'required|string|max:100',
            'button_text' => 'required|string|max:50',
            'button_link' => 'required|string|max:255',
            'is_active' => 'boolean',
            'order' => 'required|integer|min:1'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('about', 'public');
            $validated['image'] = $path;
        }

        AboutSection::create($validated);

        return redirect()->route('admin.about.index')
            ->with('success', 'About section created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AboutSection $aboutSection)
    {
        return view('admin.about.show', compact('aboutSection'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AboutSection $aboutSection)
    {
        return view('admin.about.edit', compact('aboutSection'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AboutSection $aboutSection)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'quote_1_text' => 'required|string|max:255',
            'quote_1_author' => 'required|string|max:100',
            'quote_2_text' => 'required|string|max:255',
            'quote_2_author' => 'required|string|max:100',
            'button_text' => 'required|string|max:50',
            'button_link' => 'required|string|max:255',
            'is_active' => 'boolean',
            'order' => 'required|integer|min:1'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($aboutSection->image) {
                Storage::disk('public')->delete($aboutSection->image);
            }
            $path = $request->file('image')->store('about', 'public');
            $validated['image'] = $path;
        }

        $aboutSection->update($validated);

        return redirect()->route('admin.about.index')
            ->with('success', 'About section updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AboutSection $aboutSection)
    {
        if ($aboutSection->image) {
            Storage::disk('public')->delete($aboutSection->image);
        }
        
        $aboutSection->delete();
        
        return redirect()->route('admin.about.index')
            ->with('success', 'About section deleted successfully');
    }
    
    /**
     * Get active about section for frontend
     */
    public function getActiveSection()
    {
        $aboutSection = AboutSection::where('is_active', true)
            ->orderBy('order')
            ->first();
            
        return response()->json($aboutSection);
    }
}
