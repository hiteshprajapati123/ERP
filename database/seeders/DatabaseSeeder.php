<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Create test user
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'phone' => '1234567890', // Adding required phone field
        // ]);

        // Seed hero slides
        $this->call([
            FooterContentSeeder::class,
            SocialLinkSeeder::class,
            PrivacyPolicySeeder::class,
            ContactPageSeeder::class,
            HeroSlidesTableSeeder::class,
            AboutSectionSeeder::class,
            AboutSeeder::class,
            NoticeCategorySeeder::class,
            NoticeSeeder::class,
            FeeSeeder::class,
            EventSeeder::class,
            SadqaSeeder::class,
            ZakatSeeder::class,
            FitraaSeeder::class,
            GallerySeeder::class,
            GalleryCategorySeeder::class,
            PaperSeeder::class,
            AttendanceSeeder::class,
            ExamResultSeeder::class,
            UserNoticeSeeder::class,
        ]);
    }
}
