<?php

namespace Database\Seeders;

use App\Models\NoticeCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NoticeCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Exam', 'description' => 'Exam-related notices'],
            ['name' => 'Event', 'description' => 'Events and functions'],
            ['name' => 'Announcement', 'description' => 'General announcements'],
            ['name' => 'Course Material', 'description' => 'Study materials and resources'],
            ['name' => 'Sports', 'description' => 'Sports activities and updates'],
        ];

        foreach ($categories as $cat) {
            NoticeCategory::firstOrCreate(
                ['slug' => Str::slug($cat['name'])],
                [
                    'name' => $cat['name'],
                    'description' => $cat['description'] ?? null,
                    'is_active' => true,
                ]
            );
        }
    }
}
