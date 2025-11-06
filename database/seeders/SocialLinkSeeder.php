<?php

namespace Database\Seeders;

use App\Models\SocialLink;
use Illuminate\Database\Seeder;

class SocialLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $socialLinks = [
            [
                'platform' => 'Facebook',
                'icon_class' => 'bi-facebook',
                'url' => 'https://facebook.com',
                'sort_order' => 1,
                'is_active' => true
            ],
            [
                'platform' => 'Twitter',
                'icon_class' => 'bi-twitter',
                'url' => 'https://twitter.com',
                'sort_order' => 2,
                'is_active' => true
            ],
            [
                'platform' => 'Instagram',
                'icon_class' => 'bi-instagram',
                'url' => 'https://instagram.com',
                'sort_order' => 3,
                'is_active' => true
            ],
            [
                'platform' => 'YouTube',
                'icon_class' => 'bi-youtube',
                'url' => 'https://youtube.com',
                'sort_order' => 4,
                'is_active' => true
            ]
        ];

        foreach ($socialLinks as $link) {
            SocialLink::updateOrCreate(
                ['platform' => $link['platform']],
                $link
            );
        }
    }
}
