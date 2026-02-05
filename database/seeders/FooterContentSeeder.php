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
                'content' => 'ALJAMIATUS SUNNIYA MAQBOOLIYA ARBI COLLEGE is dedicated to spreading the light of Qur’an and Sunnah while nurturing students with knowledge, discipline, and strong character. <br><br> 📖 "Seeking knowledge is an obligation upon every Muslim." <br><br> — Prophet Muhammad ﷺ',
                'is_active' => true
            ]
        );

        // Contact Section
        FooterContent::updateOrCreate(
            ['section' => 'contact'],
            [
                'address' => 'ALJAMIATUS SUNNIYA MAQBOOLIYA ARBI COLLEGE, Pargahi Bangar, Kalyanpur, Naramau, Kanpur, Uttar Pradesh 209217',
                'phone' => '+91 87390 XXXXX',
                'email' => 'info@aljamia.edu.in',
                'is_active' => true
            ]
        );
    }

}
