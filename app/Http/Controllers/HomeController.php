<?php

namespace App\Http\Controllers;

use App\Models\HeroSlide;
use App\Models\AboutSection;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the welcome page with hero slides
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $slides = HeroSlide::where('is_active', true)
            ->orderBy('order')
            ->get();
            
        $aboutSection = AboutSection::where('is_active', true)
            ->orderBy('order')
            ->first();
            
        return view('welcome', compact('slides', 'aboutSection'));
    }

    /**
     * Serve About Section image stored on the private disk.
     */
    public function aboutSectionImage(string $filename)
    {
        $path = storage_path('app/private/about(homepage)/' . $filename);

        if (! file_exists($path)) {
            abort(404);
        }

        $mime = mime_content_type($path) ?: 'application/octet-stream';

        return response()->file($path, [
            'Content-Type' => $mime,
            'Cache-Control' => 'public, max-age=604800',
        ]);
    }

    /**
     * Serve Hero Slide image stored on the private disk.
     */
    public function heroSlideImage(string $filename)
    {
        $path = storage_path('app/private/hero_slides/' . $filename);

        if (! file_exists($path)) {
            abort(404);
        }

        $mime = mime_content_type($path) ?: 'application/octet-stream';

        return response()->file($path, [
            'Content-Type' => $mime,
            'Cache-Control' => 'public, max-age=604800',
        ]);
    }
}
