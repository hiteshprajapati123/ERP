<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FitraaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Fitraa::create([
            'hero_title' => 'Give Your Fitraa',
            'hero_quote' => '"The charity of Fitra is a purification for the fasting person from idle and obscene talk, and it is food for the needy." (Sunan Abi Dawud)',
            'what_is_title' => 'What is Fitraa?',
            'what_is_content' => 'Fitraa (Zakat al-Fitr) is a charitable donation of food or its monetary equivalent that must be given to the poor before the Eid prayer at the end of Ramadan.',
            'benefits' => json_encode([
                [
                    'title' => 'Purification',
                    'description' => 'Purifies the fasting person from any indecent act or speech',
                    'icon' => 'hands-helping'
                ],
                [
                    'title' => 'Joy for All',
                    'description' => 'Ensures everyone can celebrate Eid with dignity',
                    'icon' => 'gift'
                ],
                [
                    'title' => 'Community Support',
                    'description' => 'Helps those in need within our community',
                    'icon' => 'hand-holding-heart'
                ]
            ]),
            'donation_title' => 'Donate Your Fitraa',
            'donation_description' => 'Your contribution helps ensure everyone can celebrate Eid with joy and dignity.',
            'donation_note' => 'Your donation will be used to provide essential food items to those in need before Eid.',
            'is_active' => true
        ]);
    }
}
