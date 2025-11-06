<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AboutSection>
 */
class AboutSectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => 'About Our Institute',
            'description' => 'Madarsa Nizamia Barkatia Mushtaqul Uloom is an educational institute in Naramau which provides religious and modern education.',
            'welcome_title' => 'Welcome to Our Madarsa',
            'welcome_content' => 'At Madarsa Nizamia Barqatia Mushtakqul Uloom, we provide a balanced education where students gain Islamic knowledge along with modern academic learning. Alongside traditional studies, we also conduct computer courses to ensure our students stay updated with technology and are well-prepared for the challenges of the modern world.',
            'image' => 'about/about-image.jpg',
            'quote_1_text' => 'Seek knowledge from the cradle to the grave.',
            'quote_1_author' => 'Prophet Muhammad ﷺ',
            'quote_2_text' => 'Education is the most powerful weapon which you can use to change the world.',
            'quote_2_author' => 'Nelson Mandela',
            'button_text' => 'Discover More',
            'button_link' => 'about',
            'is_active' => true,
            'order' => 1,
        ];
    }
}
