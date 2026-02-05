<?php

namespace Database\Seeders;

use App\Models\Sadqa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SadqaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
    {
        Sadqa::create([
            'hero_title' => 'Give Sadaqah for the Sake of Allah',
            'hero_quote' => '"Sadaqah extinguishes sin just as water extinguishes fire." (Tirmidhi)',
            
            'what_is_title' => 'What is Sadaqah?',
            'what_is_content' => 'Sadaqah is a voluntary charity given sincerely for the pleasure of Allah. It may be given at any time to support the poor, students of knowledge, and community needs, bringing benefit to both the giver and the receiver.',
            
            'benefits' => json_encode([
                [
                    'title' => 'Barakah in Wealth',
                    'description' => 'Increases blessings and brings barakah in your earnings',
                    'icon' => 'heart'
                ],
                [
                    'title' => 'Protection from Hardship',
                    'description' => 'Acts as a shield against difficulties and calamities',
                    'icon' => 'shield-alt'
                ],
                [
                    'title' => 'Purification of Soul',
                    'description' => 'Cleanses the heart and wealth through generosity',
                    'icon' => 'hand-holding-heart'
                ]
            ]),
            
            'donation_title' => 'Support Through Sadaqah',
            'donation_description' => 'Your Sadaqah helps students, needy families, and community programs of ALJAMIATUS SUNNIYA MAQBOOLIYA ARBI COLLEGE.',
            'donation_note' => 'All Sadaqah donations are used transparently to support Islamic education, student welfare, and community assistance.',
            
            'is_active' => true
        ]);
    }
}
