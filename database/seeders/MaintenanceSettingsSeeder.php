<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MaintenanceSettings;

class MaintenanceSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MaintenanceSettings::create([
            'is_enabled' => false,
            'title' => 'Website Under Maintenance',
            'message' => 'We are currently performing scheduled maintenance. We\'ll be back shortly!',
            'estimated_time' => '2-3 hours',
            'contact_email' => 'admin@example.com',
            'contact_phone' => '+1234567890',
        ]);
    }
}
