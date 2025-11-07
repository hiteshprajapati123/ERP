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
                // New explicit columns
                'info_we_collect' => implode("\n", [
                    'Student details (name, ID, attendance, fees, books issued)',
                    'Teacher details (name, subject, attendance records)',
                    'Contact information (address, phone number, email)'
                ]),
                'how_we_use' => implode("\n", [
                    'Maintain student records',
                    'Track attendance and academic progress',
                    'Manage fee records and library/books',
                    'Communicate important notices and events'
                ]),
                'data_protection' => 'All information is securely stored and used only by authorized staff. We do not sell, share, or misuse your personal data.',
                'your_rights' => 'You may request access, correction, or removal of your personal data by contacting our administration office.',
                'updates_to_policy' => 'We may update this Privacy Policy from time to time to reflect changes in our practices. Any updates will be posted on this page.',
                // Dates
                'last_updated' => now()->format('F Y'),
                'last_updated_date' => now()->toDateString(),
                'is_active' => true,
            ]);
        }
    }
}
