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
            'hero_title' => 'Fulfill Your Zakat Obligation',
            'hero_quote' => '"Take from their wealth a charity by which you purify them and cause them increase." (Qur’an 9:103)',
            
            'what_is_title' => 'What is Zakat?',
            'what_is_content' => 'Zakat is a mandatory act of worship and one of the five pillars of Islam. It purifies wealth, supports the poor, and strengthens the bonds of the Ummah. Every eligible Muslim must give Zakat once every lunar year.',
            
            'key_points' => json_encode([
                [
                    'title' => 'Obligatory Charity',
                    'description' => '2.5% of eligible wealth must be given as Zakat',
                    'icon' => 'scale-balanced'
                ],
                [
                    'title' => 'Nisab Threshold',
                    'description' => 'Nisab is equal to 87.48g of gold or 612.36g of silver',
                    'icon' => 'calculator'
                ],
                [
                    'title' => 'Annual Duty',
                    'description' => 'Zakat is paid once every lunar (Islamic) year',
                    'icon' => 'calendar-alt'
                ]
            ]),
            
            'donation_title' => 'Pay Your Zakat',
            'donation_description' => 'Give your Zakat through ALJAMIATUS SUNNIYA MAQBOOLIYA ARBI COLLEGE to support students of knowledge and needy families.',
            'donation_note' => 'All Zakat donations are distributed strictly according to Islamic Shariah guidelines to eligible recipients.',
            
            'nisab_gold' => 87.48,
            'nisab_silver' => 612.36,
            'is_active' => true
        ]);
    }

}
