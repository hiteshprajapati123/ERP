<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GalleryController extends Controller
{
    /**
     * Display the gallery page with categories
     */
    public function index()
    {
        // Get all unique categories from the gallery
        $dbCategories = Gallery::select('category')
            ->distinct()
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->orderBy('category')
            ->pluck('category')
            ->mapWithKeys(function($category) {
                return [strtolower($category) => ucfirst($category)];
            })
            ->toArray();
            
        $categories = array_merge(['all' => 'All'], $dbCategories);
        
        // Get initial gallery items (first page) - only 4 items initially
        $galleryItems = Gallery::orderBy('is_featured', 'desc')
            ->orderBy('order')
            ->take(4) // Initial load of 4 items
            ->get()
            ->map(function($item) {
                return [
                    'id' => $item->id,
                    'category' => $item->category,
                    'image' => $item->image_url,
                    'alt' => $item->image_alt,
                    'title' => $item->title,
                    'description' => $item->description,
                    'is_featured' => (bool)$item->is_featured,
                    'order' => $item->order,
                    'created_at' => $item->created_at->format('M d, Y')
                ];
            });
            
        return view('gallery.index', [
            'categories' => $categories,
            'initialItems' => $galleryItems
        ]);
    }
    
    /**
     * Get featured gallery items for the welcome page
     */
    public function welcomeGallery()
    {
        $galleryItems = Gallery::where('is_featured', true)
            ->orderBy('order')
            ->take(4) // Show only 4 featured items on the welcome page
            ->get();
            
        return response()->json($galleryItems);
    }
    
    /**
     * Get paginated gallery items via AJAX
     */
    public function getGalleryItems()
    {
        $category = request()->input('category', 'all');
        $page = request()->input('page', 1);
        $perPage = 4; // Load 4 items at a time
        
        $query = Gallery::query();
        
        // Filter by category if not 'all'
        if ($category !== 'all') {
            $query->where('category', $category);
        }
        
        // Get total count for pagination
        $total = $query->count();
        
        // Calculate pagination values
        $lastPage = max(1, ceil($total / $perPage));
        
        // Get paginated results
        $galleryItems = $query->orderBy('is_featured', 'desc')
            ->orderBy('order')
            ->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get()
            ->map(function($item) {
                return [
                    'id' => $item->id,
                    'category' => $item->category,
                    'image' => $item->image_url,
                    'alt' => $item->image_alt,
                    'title' => $item->title,
                    'description' => $item->description,
                    'is_featured' => (bool)$item->is_featured,
                    'order' => $item->order,
                    'created_at' => $item->created_at->format('M d, Y')
                ];
            });
            
        return response()->json([
            'items' => $galleryItems,
            'current_page' => (int)$page,
            'last_page' => $lastPage,
            'total' => $total,
            'per_page' => $perPage
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
