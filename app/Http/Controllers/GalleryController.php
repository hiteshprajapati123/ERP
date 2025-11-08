<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\GalleryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Log;

class GalleryController extends Controller
{
    /**
     * Display the gallery page with categories
     */
    public function index()
    {
        // Load categories from gallery_categories table
        $categories = GalleryCategory::orderBy('name')
            ->get()
            ->mapWithKeys(function ($cat) {
                return [$cat->slug => $cat->name];
            })->toArray();
        $categories = array_merge(['all' => 'All'], $categories);
        
        // Get initial gallery items (first page) - only 4 items initially
        $galleryItems = Gallery::orderBy('is_featured', 'desc')
            ->orderBy('order')
            ->take(4) // Initial load of 4 items
            ->get()
            ->map(function($item) {
                $normalizedPath = $this->normalizePath($item->image_url);
                return [
                    'id' => $item->id,
                    'category' => optional($item->galleryCategory)->name ?? 'Uncategorized',
                    'image' => $normalizedPath ? route('galleries.image', ['path' => $normalizedPath]) : null,
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
            ->take(4)
            ->get()
            ->map(function ($item) {
                $item->image_url = $this->normalizePath($item->image_url)
                    ? route('galleries.image', ['path' => $this->normalizePath($item->image_url)])
                    : null;
                return $item;
            });
            
        return response()->json($galleryItems);
    }
    
    /**
     * Get paginated gallery items via AJAX
     */
    public function getGalleryItems()
    {
        $category = request()->input('category', 'all'); // slug or 'all'
        $page = request()->input('page', 1);
        $perPage = 4; // Load 4 items at a time
        
        $query = Gallery::with('galleryCategory');
        
        // Filter by category if not 'all'
        if ($category !== 'all') {
            $query->whereHas('galleryCategory', function($q) use ($category) {
                $q->where('slug', $category);
            });
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
                $normalizedPath = $this->normalizePath($item->image_url);
                return [
                    'id' => $item->id,
                    'category' => optional($item->galleryCategory)->name ?? 'Uncategorized',
                    'image' => $normalizedPath ? route('galleries.image', ['path' => $normalizedPath]) : null,
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
     * Securely stream a private gallery image.
     */
    public function image(string $path): StreamedResponse
    {
        $normalized = $this->normalizePath($path);
        abort_unless($normalized && Str::startsWith($normalized, 'private/galleries/'), 404);

        abort_unless(Storage::disk('local')->exists($normalized), 404);

        $mime = Storage::disk('local')->mimeType($normalized) ?: 'application/octet-stream';
        return Storage::disk('local')->response($normalized, headers: [
            'Content-Type' => $mime,
            'Cache-Control' => 'private, max-age=86400',
        ]);
    }

    /**
     * Normalize stored file path into 'private/galleries/...' form.
     */
    protected function normalizePath(?string $path): ?string
    {
        if (!$path) return null;
        $path = str_replace('\\', '/', $path);
        $path = preg_replace('#^/?storage/app/#', '', $path);
        $path = preg_replace('#^/?app/#', '', $path);
        $path = ltrim($path, '/');
        return $path;
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
