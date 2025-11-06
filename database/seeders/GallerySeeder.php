<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galleries = [
            [
                'title' => 'Quran Class',
                'description' => 'Students learning Quran with dedication and focus',
                'image_url' => 'https://images.unsplash.com/photo-1588072432836-e100327743db?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                'image_alt' => 'Students in a Quran class',
                'category' => 'education',
                'is_featured' => true,
                'order' => 1
            ],
            [
                'title' => 'Annual Gathering',
                'description' => 'Celebrating our annual gathering with students and teachers',
                'image_url' => 'https://images.unsplash.com/photo-1519817650390-64a93db51149?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                'image_alt' => 'Annual school gathering',
                'category' => 'events',
                'is_featured' => true,
                'order' => 2
            ],
            [
                'title' => 'Islamic Studies',
                'description' => 'Deepening knowledge in Islamic teachings',
                'image_url' => 'https://images.unsplash.com/photo-1505373876331-8d30b8a4fca3?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                'image_alt' => 'Islamic studies class',
                'category' => 'education',
                'is_featured' => true,
                'order' => 3
            ],
            [
                'title' => 'Outdoor Activities',
                'description' => 'Students enjoying outdoor learning activities',
                'image_url' => 'https://images.unsplash.com/photo-1601645191163-3fc0d5d64e35?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                'image_alt' => 'Students in outdoor activities',
                'category' => 'activities',
                'is_featured' => false,
                'order' => 4
            ],
            [
                'title' => 'Arabic Language Class',
                'description' => 'Learning the beautiful Arabic language',
                'image_url' => 'https://images.unsplash.com/photo-1523050853548-5d7c4c29d3e9?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                'image_alt' => 'Arabic language class',
                'category' => 'education',
                'is_featured' => true,
                'order' => 5
            ],
            [
                'title' => 'Graduation Ceremony',
                'description' => 'Celebrating our students\' achievements',
                'image_url' => 'https://images.unsplash.com/photo-1523050853548-5d7c4c29d3e9?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=81',
                'image_alt' => 'Graduation ceremony',
                'category' => 'events',
                'is_featured' => true,
                'order' => 6
            ]
        ];

        foreach ($galleries as $gallery) {
            Gallery::create($gallery);
        }
    }
}
