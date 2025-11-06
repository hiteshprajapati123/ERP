<?php

namespace Database\Seeders;

use App\Models\HeroSlide;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class HeroSlidesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing slides
        HeroSlide::truncate();

        // Create storage directory if it doesn't exist
        $directory = 'public/hero-slides';
        if (!Storage::exists($directory)) {
            Storage::makeDirectory($directory);
            
            // Create sample images directory in storage
            $sampleDir = storage_path('app/public/hero-slides');
            if (!file_exists($sampleDir)) {
                mkdir($sampleDir, 0755, true);
            }
            
            // Create sample images
            $images = [
                'slide1.jpg' => file_get_contents(public_path('images/slide1.jpg')),
                'slide2.jpg' => file_get_contents(public_path('img/logo.jpeg')),
                'slide3.jpg' => file_get_contents(public_path('images/slide3.jpg')),
            ];
            
            foreach ($images as $filename => $content) {
                Storage::put('public/hero-slides/' . $filename, $content);
            }
        }

        // Sample slides data
        $slides = [
            [
                'title' => 'Welcome to Madarsa Nizamia Barkatia Mushtaqul Uloom',
                'description' => 'Empowering Knowledge with Faith & Wisdom',
                'image' => 'hero-slides/slide1.jpg',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Learn. Grow. Inspire.',
                'description' => 'Building a strong foundation for your future',
                'image' => 'hero-slides/slide2.jpg',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Faith. Education. Excellence.',
                'description' => 'Together we create a better tomorrow',
                'image' => 'hero-slides/slide3.jpg',
                'order' => 3,
                'is_active' => true,
            ]
        ];

        foreach ($slides as $slide) {
            HeroSlide::create($slide);
        }
    }
}
