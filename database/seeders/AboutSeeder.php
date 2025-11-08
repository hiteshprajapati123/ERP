<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::create([
            'page_title' => 'About Us',
            'intro_content' => 'At Madarsa Nizamia Barqatia Mushtakqul Uloom, we are dedicated to providing Islamic Taleem alongside modern academic education. Our goal is to prepare students for both deen and duniya, ensuring they succeed in faith, knowledge, and life.',
            'vision' => 'To nurture future leaders with strong Islamic values and modern knowledge.',
            'mission' => 'To combine Islamic studies, academic subjects, and computer education for the holistic development of every student.',
            'history_content' => 'Established to spread the light of both deen and worldly knowledge, our Madarsa has grown into a trusted center of learning. With dedicated teachers and a focus on excellence, we continue to serve the community with pride.',
            'what_we_offer' => json_encode([
                'Islamic Studies (Qur\'an, Hadees, Fiqh, Tafseer)',
                'Academic Subjects (Maths, Science, Languages, Social Studies)',
                'Computer Courses (Digital Literacy, MS Office, Internet Skills)',
                'Co-curricular Activities (Debates, Sports, Community Service)'
            ]),
            'highlights' => json_encode([
                'Quality Education',
                'Experienced Teachers',
                'Community Programs',
                'Computer & Technology Courses',
                'Holistic Development'
            ]),
            'programs' => json_encode([
                'Islamic Studies: Qur\'an, Hadees, Fiqh, Tafseer',
                'Academic Subjects: Maths, Science, Languages',
                'Computer Education: Digital literacy, MS Office, Internet Skills',
                'Co-curricular: Debates, Sports, Social Service'
            ]),
            'principal_message' => 'Education is not only about books; it is about building character, faith, and responsibility. At our Madarsa, we strive to create students who excel in knowledge while staying rooted in Islamic values.',
            'contact_address' => 'Madarsa Nizamia Barqatia Mushtakqul Uloom, [Your City, UP]',
            'contact_phone' => '+91-87390 90638',
            'contact_email' => 'info@madarsa.com',
            'is_active' => true,
        ]);
    }
}
