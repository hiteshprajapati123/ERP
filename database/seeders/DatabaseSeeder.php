<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Create test user
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'phone' => '1234567890', // Adding required phone field
        // ]);

        // Seed hero slides
        $this->call([
            MaintenanceSettingsSeeder::class,
            FooterContentSeeder::class,
            SocialLinkSeeder::class,
            PrivacyPolicySeeder::class,
            ContactPageSeeder::class,
            AboutSectionSeeder::class,
            AboutSeeder::class,
            SadqaSeeder::class,
            ZakatSeeder::class,
            FitraaSeeder::class,
        ]);
    }
}
