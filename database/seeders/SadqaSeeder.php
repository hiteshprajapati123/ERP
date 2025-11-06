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
            'hero_title' => 'Give Sadaqah',
            'hero_quote' => '"The believer\'s shade on the Day of Resurrection will be their charity." (Al-Tirmidhi)',
            'what_is_title' => 'What is Sadaqah?',
            'what_is_content' => 'Sadaqah is a voluntary act of charity given to please Allah and help those in need, without any expectation of return or reward from the recipient.',
            'benefits' => json_encode([
                [
                    'title' => 'Blessings',
                    'description' => 'Brings blessings and increases in wealth',
                    'icon' => 'heart'
                ],
                [
                    'title' => 'Protection',
                    'description' => 'Protects from calamities and difficulties',
                    'icon' => 'shield-alt'
                ],
                [
                    'title' => 'Purification',
                    'description' => 'Purifies the soul and wealth',
                    'icon' => 'hand-holding-heart'
                ]
            ]),
            'donation_title' => 'Donate Sadaqah',
            'donation_description' => 'Your Sadaqah can make a difference in someone\'s life today.',
            'donation_note' => 'Your Sadaqah will be used to support those in need within our community.',
            'is_active' => true
        ]);
    }
}
