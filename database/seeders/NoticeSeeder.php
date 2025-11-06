<?php

namespace Database\Seeders;

use App\Models\Notice;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class NoticeSeeder extends Seeder
{
    public function run()
    {
        $notices = [
            [
                'title' => 'Annual Examination Schedule',
                'description' => 'Detailed schedule for the upcoming annual examinations.',
                'type' => 'exam',
                'notice_date' => now(),
                'file_name' => 'exam_schedule_2024.pdf',
                'file_size' => 2500000, // 2.5MB
                'file_type' => 'application/pdf',
                'is_published' => true,
            ],
            [
                'title' => 'Eid Milad-un-Nabi Celebration',
                'description' => 'Join us for the blessed occasion of Eid Milad-un-Nabi (S.A.W)',
                'type' => 'event',
                'notice_date' => now(),
                'event_date' => now()->addDays(15),
                'location' => 'Main Hall, Madrasa Nizamia Barkatia',
                'is_published' => true,
            ],
            [
                'title' => 'Library Timings Update',
                'description' => 'The madrasa library will now remain open from 9:00 AM to 6:00 PM on all working days.',
                'type' => 'announcement',
                'notice_date' => now(),
                'is_published' => true,
            ],
            [
                'title' => 'New Course Materials',
                'description' => 'Download the latest course materials for the new semester.',
                'type' => 'course_material',
                'notice_date' => now()->subDays(5),
                'file_name' => 'course_materials_2024.zip',
                'file_size' => 1800000, // 1.8MB
                'file_type' => 'application/zip',
                'is_published' => true,
            ],
            [
                'title' => 'Sports Day Announcement',
                'description' => 'Annual sports day will be held next month. All students are encouraged to participate.',
                'type' => 'event',
                'notice_date' => now()->subDays(2),
                'event_date' => now()->addDays(20),
                'location' => 'School Ground',
                'is_published' => true,
            ]
        ];

        foreach ($notices as $notice) {
            Notice::create($notice);
        }
    }
}