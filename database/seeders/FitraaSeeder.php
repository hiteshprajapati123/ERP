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
            'hero_title' => 'Pay Your Fitraa (Zakat-ul-Fitr)',
            'hero_quote' => '"The Messenger of Allah ﷺ made Zakat-ul-Fitr obligatory as purification for the fasting person and as food for the needy." (Sunan Abi Dawud)',
            
            'what_is_title' => 'What is Fitraa?',
            'what_is_content' => 'Fitraa (Zakat-ul-Fitr) is a compulsory charity that every Muslim must give at the end of Ramadan before the Eid prayer. It purifies the fast from mistakes and helps the poor celebrate Eid with happiness and dignity.',
            
            'benefits' => json_encode([
                [
                    'title' => 'Purification of Fast',
                    'description' => 'Cleanses the fasting person from shortcomings, idle talk, and mistakes during Ramadan',
                    'icon' => 'hands-helping'
                ],
                [
                    'title' => 'Happiness on Eid',
                    'description' => 'Allows needy families to celebrate Eid with respect and joy',
                    'icon' => 'gift'
                ],
                [
                    'title' => 'Support for the Needy',
                    'description' => 'Provides essential food and help to deserving families in the community',
                    'icon' => 'hand-holding-heart'
                ]
            ]),
            
            'donation_title' => 'Contribute Your Fitraa',
            'donation_description' => 'Your Fitraa helps us reach needy families before Eid and spreads joy where it is needed most.',
            'donation_note' => 'All Fitraa donations collected through ALJAMIATUS SUNNIYA MAQBOOLIYA ARBI COLLEGE are distributed to deserving beneficiaries before Eid prayer.',
            
            'is_active' => true
        ]);
    }

}
