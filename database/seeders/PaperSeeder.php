<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $papers = [
            [
                'title' => 'Mathematics - 2024',
                'class' => '10',
                'subject' => 'Mathematics',
                'year' => 2024,
                'term' => 'Annual Examination',
                'file_path' => 'papers/math_2024_annual.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Science - 2024',
                'class' => '9',
                'subject' => 'Science',
                'year' => 2024,
                'term' => 'First Term',
                'file_path' => 'papers/science_2024_term1.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'English - 2023',
                'class' => '8',
                'subject' => 'English',
                'year' => 2023,
                'term' => 'Annual Examination',
                'file_path' => 'papers/english_2023_annual.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        \App\Models\Paper::insert($papers);
    }
}
