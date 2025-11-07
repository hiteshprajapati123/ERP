@php
    $policy = \App\Models\PrivacyPolicy::where('is_active', true)->first();

    // Build sections from explicit columns when available
    $sections = [];
    if ($policy) {
        if (!empty($policy->info_we_collect)) {
            $sections[] = ['title' => 'Information We Collect', 'content' => $policy->info_we_collect];
        }
        if (!empty($policy->how_we_use)) {
            $sections[] = ['title' => 'How We Use Your Information', 'content' => $policy->how_we_use];
        }
        if (!empty($policy->data_protection)) {
            $sections[] = ['title' => 'Data Protection', 'content' => $policy->data_protection];
        }
        if (!empty($policy->your_rights)) {
            $sections[] = ['title' => 'Your Rights', 'content' => $policy->your_rights];
        }
        if (!empty($policy->updates_to_policy)) {
            $sections[] = ['title' => 'Updates to Policy', 'content' => $policy->updates_to_policy];
        }

        // Fallback to old JSON field if explicit columns are empty
        if (empty($sections) && !empty($policy->sections)) {
            $sections = is_string($policy->sections) ? json_decode($policy->sections, true) : $policy->sections;
        }
    }

    // No hard defaults; follow About page behavior
    if (!$policy) {
        $sections = [];
    }
@endphp

@extends('layouts.app', ['title' => $policy->title ?? 'Privacy Policy'])

@section('content')
<style>
    /* Match About page look */
    .privacy-page main { padding: 2rem 0; }
    .privacy-page section.block {
        background: white;
        border-radius: 8px;
        padding: 2rem;
        margin-top: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        border-left: 3px solid transparent;
    }
    main { margin-top: 130px; }
    .privacy-page section.block:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        border-left: 3px solid #1A5D3B;
    }
    .privacy-page h2 { color:#1A5D3B; margin-top:0; padding-bottom:.5rem; border-bottom:2px solid #D4AF37; }
    .privacy-page ul { padding-left:1.5rem; }
    .privacy-page li { margin-bottom:.5rem; line-height:1.7; }
    @media (max-width: 768px){ .privacy-page .container{ padding:1rem; } .privacy-page section.block{ padding:1.5rem; } }
</style>

@if($policy)
<main class="container privacy-page">
    <!-- Intro -->
    <section class="block">
        <h2>{{ $policy->title }}</h2>
        @if(!empty($policy->subtitle))
            <p class="text-muted mb-3">{{ $policy->subtitle }}</p>
        @endif
        @if(!empty($policy->introduction))
            <div class="content">{!! $policy->introduction !!}</div>
        @endif
    </section>

    <!-- Sections -->
    @foreach(($sections ?? []) as $index => $section)
        @php $content = $section['content'] ?? ''; @endphp
        <section class="block">
            <h2>{{ ($index + 1) . '. ' . ($section['title'] ?? 'Section') }}</h2>
            @if(is_array($content))
                <ul>
                    @foreach($content as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            @else
                <p>{!! nl2br(e($content)) !!}</p>
            @endif
        </section>
    @endforeach

    <!-- Footer meta -->
    <section class="block" style="border-left-color:transparent;">
        <p class="mb-0" style="font-style: italic; color: #718096;">
            <b>Last Updated:</b>
            @if(!empty($policy->last_updated_date))
                {{ \Carbon\Carbon::parse($policy->last_updated_date)->format('F Y') }}
            @else
                {{ $policy->last_updated ?? '' }}
            @endif
        </p>
    </section>
</main>
@else
<div class="container py-5 text-center">
    <div class="alert alert-info">
        <h4>Privacy Policy content is not available at the moment.</h4>
        <p class="mb-0">Please check back later or contact the administrator.</p>
    </div>
</div>
@endif
@endsection
