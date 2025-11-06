@php
    $privacyPolicy = \App\Models\PrivacyPolicy::where('is_active', true)->first();
    
    // Fallback data in case no active privacy policy is found
    if (!$privacyPolicy) {
        $privacyPolicy = new \stdClass();
        $privacyPolicy->title = 'Privacy Policy';
        $privacyPolicy->subtitle = 'Your privacy is important to us. Learn how we handle your information.';
        $privacyPolicy->introduction = 'At <b>Madarsa Nizamia Barqatia Mushtaqqul Uloom</b>, we respect your privacy and are committed to protecting the personal information of our students, teachers, and community members. This Privacy Policy explains how we handle your data.';
        $privacyPolicy->sections = [
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
        ];
        $privacyPolicy->last_updated = 'November 2024';
    } else {
        // Convert JSON string to array if it's a string
        if (is_string($privacyPolicy->sections)) {
            $privacyPolicy->sections = json_decode($privacyPolicy->sections, true);
        }
    }
@endphp

@extends('layouts.app', ['title' => $privacyPolicy->title])

@section('content')
<!-- Privacy Policy Hero Section -->
<section style="background: linear-gradient(rgba(26, 93, 59, 0.9), rgba(26, 93, 59, 0.8)), url('https://images.unsplash.com/photo-1454165804606-c3da57af4b00?auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center; padding: 80px 0 60px; color: white; text-align: center;">
    <div style="max-width: 800px; margin: 0 auto; padding: 0 20px;">
        <h1 style="font-size: 42px; margin: 0 0 15px; font-weight: 700;">{{ $privacyPolicy->title }}</h1>
        <p style="font-size: 18px; margin: 0; opacity: 0.9;">{{ $privacyPolicy->subtitle }}</p>
    </div>
</section>

<!-- Privacy Policy Content -->
<section style="padding: 60px 0; background: #f8f9fa;">
    <div style="max-width: 1000px; margin: 0 auto; padding: 0 15px;">
        <div style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 5px 30px rgba(0,0,0,0.05); padding: 50px;">
            <div class="privacy-content" style="line-height: 1.8; color: #4a5568;">
                <div style="margin-bottom: 25px;">
                    {!! $privacyPolicy->introduction !!}
                </div>

                @foreach($privacyPolicy->sections as $index => $section)
                    <section style="margin-bottom: 30px;">
                        <h3 style="color: #1A5D3B; font-size: 22px; margin-bottom: 15px; padding-bottom: 10px; border-bottom: 2px solid #D4AF37;">
                            {{ $index + 1 }}. {{ $section['title'] }}
                        </h3>
                        
                        @if(is_array($section['content']))
                            <ul style="padding-left: 20px; margin-bottom: 20px;">
                                @foreach($section['content'] as $item)
                                    <li style="margin-bottom: 8px;">
                                        @if(str_contains($item, 'Student details'))
                                            👤 {{ $item }}
                                        @elseif(str_contains($item, 'Teacher details'))
                                            👨‍🏫 {{ $item }}
                                        @elseif(str_contains($item, 'Contact information'))
                                            📩 {{ $item }}
                                        @else
                                            {{ $item }}
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>{{ $section['content'] }}</p>
                        @endif
                    </section>
                @endforeach

                <p style="font-style: italic; color: #718096; margin-top: 40px; padding-top: 20px; border-top: 1px solid #e2e8f0;">
                    <b>Last Updated:</b> {{ $privacyPolicy->last_updated }}
                </p>
            </div>
        </div>
    </div>
</section>
<style>
    main {
        margin-top: 20px;
    }
</style>
@endsection
