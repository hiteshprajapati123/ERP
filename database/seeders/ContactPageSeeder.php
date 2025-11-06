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
                'address' => '123 Islamic Center Road, Naramau, Uttar Pradesh, India',
                'phone1' => '+91 98765 43210',
                'phone2' => '+91 98765 43211',
                'email1' => 'info@madrasanizamia.com',
                'email2' => 'support@madrasanizamia.com',
                'is_active' => true,
            ]);
        }
    }
}
