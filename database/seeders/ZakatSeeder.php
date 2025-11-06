<?php

namespace Database\Seeders;

use App\Models\Zakat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ZakatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Zakat::create([
            'hero_title' => 'Pay Your Zakat',
            'hero_quote' => '"And establish prayer and give Zakat, and whatever good you put forward for yourselves - you will find it with Allah." (Quran 2:110)',
            'what_is_title' => 'What is Zakat?',
            'what_is_content' => 'Zakat is one of the Five Pillars of Islam, an obligatory act of charity that purifies wealth and helps those in need.',
            'key_points' => json_encode([
                [
                    'title' => 'Obligation',
                    'description' => '2.5% of your eligible wealth',
                    'icon' => 'scale-balanced'
                ],
                [
                    'title' => 'Nisab Value',
                    'description' => 'Current Nisab: 87.48g of gold or 612.36g of silver',
                    'icon' => 'calculator'
                ],
                [
                    'title' => 'Annual Payment',
                    'description' => 'Payable once every lunar year',
                    'icon' => 'calendar-alt'
                ]
            ]),
            'donation_title' => 'Pay Your Zakat',
            'donation_description' => 'Calculate and pay your Zakat to fulfill this important pillar of Islam.',
            'donation_note' => 'Your Zakat will be distributed to those who are eligible to receive it according to Islamic guidelines.',
            'nisab_gold' => 87.48,
            'nisab_silver' => 612.36,
            'is_active' => true
        ]);
    }
}
