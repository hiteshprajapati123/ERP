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
            'title' => 'About Our Institution',
            'description' => 'ALJAMIATUS SUNNIYA MAQBOOLIYA ARBI COLLEGE is a center of Islamic and Arabic learning committed to nurturing knowledge, character, and faith.',
            
            'welcome_title' => 'Welcome to ALJAMIATUS SUNNIYA MAQBOOLIYA ARBI COLLEGE',
            'welcome_content' => 'At ALJAMIATUS SUNNIYA MAQBOOLIYA ARBI COLLEGE, we offer a balanced system of education that combines authentic Islamic sciences with modern academic knowledge. Our goal is to prepare students who are strong in Imaan, rich in knowledge, and capable of serving the Ummah and society with wisdom. Along with religious education, we also provide basic computer and digital learning to help students adapt to the modern world.',
            
            'image' => 'about/about-image.jpg',
            
            'quote_1_text' => 'The best among you are those who learn the Qur’an and teach it.',
            'quote_1_author' => 'Prophet Muhammad ﷺ',
            
            'quote_2_text' => 'Education is the most powerful tool to transform individuals and societies.',
            'quote_2_author' => 'Inspired by Nelson Mandela',
            
            'button_text' => 'Learn More',
            'button_link' => 'about',
            
            'is_active' => true,
            'order' => 1,
        ];
    }

}
