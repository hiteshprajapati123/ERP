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
            'intro_content' => 'ALJAMIATUS SUNNIYA MAQBOOLIYA ARBI COLLEGE is a distinguished center of Islamic learning dedicated to preserving the teachings of the Qur’an and Sunnah while equipping students with essential modern knowledge. Our institution aims to develop knowledgeable, disciplined, and morally strong individuals who can serve the Ummah and society with wisdom and integrity.',
            
            'vision' => 'To become a leading Islamic educational institution that produces scholars and responsible citizens guided by Qur’an, Sunnah, and ethical values.',
            
            'mission' => 'To provide authentic Islamic education along with modern academic and technical skills, nurturing students spiritually, intellectually, and socially.',
            
            'history_content' => 'Founded with the noble intention of spreading Islamic knowledge, ALJAMIATUS SUNNIYA MAQBOOLIYA ARBI COLLEGE has been a beacon of learning for students seeking both religious and worldly success. Through the guidance of qualified Asatiza and the support of the community, the Madarsa continues to grow as a trusted institution of Islamic education.',
            
            'what_we_offer' => json_encode([
                'Islamic Sciences (Qur’an, Tajweed, Hadees, Fiqh, Tafseer, Aqeedah)',
                'Arabic Language & Literature (Nahw, Sarf, Balaghat)',
                'Modern Education (Maths, Science, English, Social Studies)',
                'Computer & Digital Skills (Basic Computing, Internet Awareness)',
                'Character Building & Tarbiyah Programs'
            ]),
            
            'highlights' => json_encode([
                'Strong Islamic Environment',
                'Qualified & Experienced Asatiza',
                'Focus on Tarbiyah and Akhlaq',
                'Balanced Deen & Duniya Education',
                'Student-Centered Learning Approach'
            ]),
            
            'programs' => json_encode([
                'Hifz & Nazira Qur’an Program',
                'Aalimiyat & Fazilat Courses',
                'Arabic Language Program',
                'Modern Academic Subjects',
                'Basic Computer Education',
                'Moral & Character Development Activities'
            ]),
            
            'principal_message' => 'Our aim is to nurture students who carry the light of knowledge, the strength of faith, and the beauty of good character. At ALJAMIATUS SUNNIYA MAQBOOLIYA ARBI COLLEGE, we believe true success lies in living by Islamic values while contributing positively to the world.',
            
            'contact_address' => 'ALJAMIATUS SUNNIYA MAQBOOLIYA ARBI COLLEGE, [Your City, State]',
            'contact_phone' => '+91-XXXXXXXXXX',
            'contact_email' => 'info@aljamia.edu.in',
            'is_active' => true,
        ]);
    }

}
