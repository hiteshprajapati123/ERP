<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 20 random events
        Event::factory()->count(20)->create();

        // Create some featured events
        Event::factory()
            ->count(5)
            ->featured()
            ->create();

        // Create some upcoming events
        Event::factory()
            ->count(10)
            ->upcoming()
            ->create();

        // Create some past events
        Event::factory()
            ->count(5)
            ->past()
            ->create();
    }
}
