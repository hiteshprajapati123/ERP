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
}
