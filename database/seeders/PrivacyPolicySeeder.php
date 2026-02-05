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
                'subtitle' => 'Your trust matters to us. Learn how your information is protected.',
                
                'introduction' => 'At <b>ALJAMIATUS SUNNIYA MAQBOOLIYA ARBI COLLEGE</b>, we value the privacy of our students, parents, teachers, and community members. This Privacy Policy explains how we collect, use, and safeguard information through our ERP system and official platforms.',
                
                // Info We Collect
                'info_we_collect' => implode("\n", [
                    'Student information (name, registration number, class, attendance, fee records)',
                    'Teacher and staff information (name, designation, attendance, assigned subjects)',
                    'Parent/guardian contact details (phone number, email, address)',
                    'Academic records, examination results, and library data',
                    'System usage data for security and performance monitoring'
                ]),
                
                // How We Use Data
                'how_we_use' => implode("\n", [
                    'To manage student admissions and academic records',
                    'To track attendance, exams, and progress reports',
                    'To manage fee payments and library services',
                    'To communicate notices, circulars, and important updates',
                    'To ensure secure and smooth operation of the ERP system'
                ]),
                
                'data_protection' => 'All personal data is stored securely and accessed only by authorized personnel. We do not sell, share, or disclose personal information to third parties except when required by law or with consent.',
                
                'your_rights' => 'You have the right to access, correct, or request deletion of your personal information by contacting the administration office of the college.',
                
                'updates_to_policy' => 'This Privacy Policy may be updated periodically to reflect improvements in our systems or changes in regulations. Any updates will be published on this page.',
                
                // Dates
                'last_updated' => now()->format('F Y'),
                'last_updated_date' => now()->toDateString(),
                'is_active' => true,
            ]);
        }
    }
}
