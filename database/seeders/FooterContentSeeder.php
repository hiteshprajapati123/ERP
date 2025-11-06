<?php

namespace Database\Seeders;

use App\Models\FooterContent;
use Illuminate\Database\Seeder;

class FooterContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // About Section
        FooterContent::updateOrCreate(
            ['section' => 'about'],
            [
                'content' => 'Our mission is to provide quality education and guidance. <br><br> 📖 "Acquire knowledge and impart it to the people." — Prophet Muhammad ﷺ',
                'is_active' => true
            ]
        );

        // Contact Section
        FooterContent::updateOrCreate(
            ['section' => 'contact'],
            [
                'address' => 'masjid, Pargahi Bangar, Kalyanpur, Naramau, Kanpur, Uttar Pradesh 209217',
                'phone' => '+91 87390 90638',
                'email' => 'info@madarsa.com',
                'is_active' => true
            ]
        );
    }
}
