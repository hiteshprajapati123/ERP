<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserNotice;
use App\Models\NoticeCategory;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserNoticeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        
        if (!$user) {
            $this->command->info('No users found. Please run UserSeeder first.');
            return;
        }

        // Get notice categories
        $generalCategory = NoticeCategory::where('slug', 'general')->first();
        $examCategory = NoticeCategory::where('slug', 'exam')->first();
        
        // If categories don't exist, create them
        if (!$generalCategory) {
            $generalCategory = NoticeCategory::create([
                'name' => 'General',
                'slug' => 'general',
                'description' => 'General notices and announcements',
                'is_active' => true,
            ]);
        }
        
        if (!$examCategory) {
            $examCategory = NoticeCategory::create([
                'name' => 'Exam',
                'slug' => 'exam',
                'description' => 'Examination related notices',
                'is_active' => true,
            ]);
        }

        $notices = [
            [
                'title' => 'Welcome to Student Portal',
                'description' => 'Important information about using the student portal',
                'notice_category_id' => $generalCategory->id,
                'slug' => 'welcome-to-student-portal',
                'content' => '<p>Welcome to our student portal! This is where you can find all your academic information, notices, and resources in one place.</p>',
                'publish_date' => now(),
                'is_pinned' => true,
                'is_important' => true,
                'created_by' => $user->id,
            ],
            [
                'title' => 'Midterm Exam Schedule',
                'description' => 'Schedule for the upcoming midterm examinations',
                'notice_category_id' => $examCategory->id,
                'slug' => 'midterm-exam-schedule',
                'content' => '<p>Midterm examinations will be held from <strong>December 15 to December 20, 2024</strong>. Please check your exam schedule in the exam section.</p>',
                'file_name' => 'midterm_schedule.pdf',
                'file_size' => '250 KB',
                'file_type' => 'application/pdf',
                'publish_date' => now(),
                'expiry_date' => now()->addMonth(),
                'is_important' => true,
                'created_by' => $user->id,
            ],
        ];

        foreach ($notices as $notice) {
            if (!UserNotice::where('slug', $notice['slug'])->exists()) {
                UserNotice::create($notice);
            }
        }

        $this->command->info('User notices seeded successfully!');
    }
}
