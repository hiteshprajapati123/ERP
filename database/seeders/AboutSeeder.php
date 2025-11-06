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
            'intro_content' => 'At <strong>Madarsa Nizamia Barqatia Mushtakqul Uloom</strong>, we are dedicated to providing <b>Islamic Taleem</b> alongside <b>modern academic education</b>. Our goal is to prepare students for both <i>deen and duniya</i>, ensuring they succeed in faith, knowledge, and life.',
            'vision' => 'To nurture future leaders with strong Islamic values and modern knowledge.',
            'mission' => 'To combine Islamic studies, academic subjects, and computer education for the holistic development of every student.',
            'history_content' => 'Established to spread the light of both <b>deen and worldly knowledge</b>, our Madarsa has grown into a trusted center of learning. With dedicated teachers and a focus on excellence, we continue to serve the community with pride.',
            'what_we_offer' => json_encode([
                '📖 Islamic Studies (Qur\'an, Hadees, Fiqh, Tafseer)',
                '📚 Academic Subjects (Maths, Science, Languages, Social Studies)',
                '💻 Computer Courses (Digital Literacy, MS Office, Internet Skills)',
                '⚽ Co-curricular Activities (Debates, Sports, Community Service)'
            ]),
            'highlights' => json_encode([
                '📚 Quality Education',
                '👩‍🏫 Experienced Teachers',
                '🌍 Community Programs',
                '💻 Computer & Technology Courses',
                '🌱 Holistic Development'
            ]),
            'programs' => json_encode([
                'Islamic Studies: Qur\'an, Hadees, Fiqh, Tafseer',
                'Academic Subjects: Maths, Science, Languages',
                'Computer Education: Digital literacy, MS Office, Internet Skills',
                'Co-Curricular: Debates, Sports, Social Service'
            ]),
            'principal_message' => '\"Education is not only about books; it is about <b>building character, faith, and responsibility</b>. At our Madarsa, we strive to create students who excel in knowledge while staying rooted in Islamic values.\"',
            'principal_name' => 'Maulana Mohammad Ali',
            'principal_title' => 'Principal',
            'contact_address' => 'Madarsa Nizamia Barqatia Mushtakqul Uloom, [Your City, UP]',
            'contact_phone' => '+91-87390 90638',
            'contact_email' => 'info@madarsa.com',
            'is_active' => true,
            'meta_title' => 'About Madarsa Nizamia Barqatia Mushtakqul Uloom',
            'meta_description' => 'Learn about our mission, vision, and the quality education we provide in both Islamic and modern studies.',
            'meta_keywords' => 'madrasa, islamic education, modern education, quran, hadees, fiqh, tafseer, academic subjects, computer education'
        ]);
    }
}
