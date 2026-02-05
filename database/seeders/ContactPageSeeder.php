<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if contact page data already exists
        if (!\App\Models\ContactPage::exists()) {
            \App\Models\ContactPage::create([
                'address' => 'ALJAMIATUS SUNNIYA MAQBOOLIYA ARBI COLLEGE, [Your City, State], India',
                'phone1' => '+91-XXXXXXXXXX',
                'phone2' => '+91-YYYYYYYYYY',
                'email1' => 'info@aljamia.edu.in',
                'email2' => 'support@aljamia.edu.in',
                'is_active' => true,
            ]);
        }
    }
}
