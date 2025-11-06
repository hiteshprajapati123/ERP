<?php

namespace Database\Seeders;

use App\Models\PrivacyPolicy;
use Illuminate\Database\Seeder;

class PrivacyPolicySeeder extends Seeder
{
    public function run()
    {
        // Only create if no privacy policy exists
        if (!PrivacyPolicy::exists()) {
            PrivacyPolicy::create([
                'title' => 'Privacy Policy',
                'subtitle' => 'Your privacy is important to us. Learn how we handle your information.',
                'introduction' => 'At <b>Madarsa Nizamia Barqatia Mushtaqqul Uloom</b>, we respect your privacy and are committed to protecting the personal information of our students, teachers, and community members. This Privacy Policy explains how we handle your data.',
                'sections' => [
                    [
                        'title' => 'Information We Collect',
                        'content' => [
                            'Student details (name, ID, class, attendance, fees, books issued)',
                            'Teacher details (name, subject, attendance records)',
                            'Contact information (address, phone number, email)'
                        ]
                    ],
                    [
                        'title' => 'How We Use Your Information',
                        'content' => [
                            'To maintain student records',
                            'To track attendance and academic progress',
                            'To manage fee records and library/books',
                            'To communicate important notices and events'
                        ]
                    ],
                    [
                        'title' => 'Data Protection',
                        'content' => 'All information is securely stored and used only by authorized staff. We do not sell, share, or misuse your personal data.'
                    ],
                    [
                        'title' => 'Your Rights',
                        'content' => 'Students and parents have the right to access, correct, or request removal of their personal data by contacting our administration office.'
                    ],
                    [
                        'title' => 'Updates to Policy',
                        'content' => 'We may update this Privacy Policy from time to time to reflect changes in our practices. Any updates will be posted on this page.'
                    ]
                ],
                'last_updated' => now()->format('F Y'), // Automatically sets to current month and year (e.g., 'November 2025')
                'is_active' => true
            ]);
        }
    }
}
