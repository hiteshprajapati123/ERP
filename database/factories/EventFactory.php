<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(4);
        $eventDate = $this->faker->dateTimeBetween('now', '+1 year');
        
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => $this->faker->paragraphs(3, true),
            'event_date' => $eventDate,
            'start_time' => $this->faker->time('H:i:s'),
            'end_time' => $this->faker->time('H:i:s', strtotime('+2 hours')),
            'location' => $this->faker->randomElement([
                'Main Prayer Hall',
                'Community Center',
                'Islamic Center Auditorium',
                'Outdoor Garden',
                'Multi-Purpose Hall'
            ]),
            'address' => $this->faker->address,
            'image_url' => $this->faker->randomElement([
                'https://source.unsplash.com/random/800x600?islamic,mosque',
                'https://source.unsplash.com/random/800x600?islamic,event',
                'https://source.unsplash.com/random/800x600?quran,recitation',
                'https://source.unsplash.com/random/800x600?islamic,community',
                'https://source.unsplash.com/random/800x600?ramadan,iftar'
            ]),
            'is_featured' => $this->faker->boolean(30), // 30% chance of being featured
            'registration_required' => $this->faker->boolean(70), // 70% chance of requiring registration
            'max_attendees' => $this->faker->numberBetween(20, 200),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Indicate that the event is featured.
     */
    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_featured' => true,
        ]);
    }

    /**
     * Indicate that the event is upcoming.
     */
    public function upcoming(): static
    {
        return $this->state(fn (array $attributes) => [
            'event_date' => $this->faker->dateTimeBetween('+1 day', '+1 month'),
        ]);
    }

    /**
     * Indicate that the event is in the past.
     */
    public function past(): static
    {
        return $this->state(fn (array $attributes) => [
            'event_date' => $this->faker->dateTimeBetween('-1 year', '-1 day'),
        ]);
    }
}
