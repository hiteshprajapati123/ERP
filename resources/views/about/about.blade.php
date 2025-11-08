@extends('layouts.app', ['title' => $about->page_title ?? 'About Us'])

@section('content')
<style>
    /* About Page Content Styles */
    .about-page main {
        padding: 2rem 0;
    }

    .about-page section {
        background: white;
        border-radius: 8px;
        padding: 2rem;
        margin-top: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        border-left: 3px solid transparent;
    }

    main {
        margin-top: 130px;
    }

    .about-page section:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        border-left: 3px solid #1A5D3B;
    }

    .about-page h2 {
        color: #1A5D3B;
        margin-top: 0;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #D4AF37;
    }

    .about-page ul {
        padding-left: 1.5rem;
    }

    .about-page li {
        margin-bottom: 0.5rem;
        line-height: 1.7;
    }

    @media (max-width: 768px) {
        .about-page .container {
            padding: 1rem;
        }
        
        .about-page section {
            padding: 1.5rem;
        }
    }
</style>

@if($about)
<main class="container about-page">
    {{-- Banner removed as per requirements --}}
    
    <!-- Intro Section -->
    <section class="intro">
        <h2>{{ $about->page_title }}</h2>
        <div class="row">
            <div class="content">
                {{ $about->intro_content }}
            </div>
        </div>
    </section>

    @if($about->vision || $about->mission)
    <!-- Vision & Mission -->
    <section class="vision-mission">
        <h2>Our Vision & Mission</h2>
        <div class="row">
            @if($about->vision)
            <div class="col-md-6">
                <h3>Vision</h3>
                <p>{{ $about->vision }}</p>
            </div>
            @endif
            @if($about->mission)
            <div class="col-md-6">
                <h3>Mission</h3>
                <p>{{ $about->mission }}</p>
            </div>
            @endif
        </div>
    </section>
    @endif

    @if($about->history_content)
    <!-- History -->
    <section class="history">
        <h2>Our History</h2>
        <div class="content">
            {{ $about->history_content }}
        </div>
    </section>
    @endif

    @if(!empty($about->decoded_what_we_offer))
    <!-- What We Offer -->
    <section class="what-we-offer">
        <h2>What We Offer</h2>
        <ul>
            @foreach($about->decoded_what_we_offer as $item)
            @php
                $t = strtolower($item);
                $icon = 'fa-check-circle';
                if (str_contains($t, 'islamic')) $icon = 'fa-book-open';
                elseif (str_contains($t, 'academic')) $icon = 'fa-graduation-cap';
                elseif (str_contains($t, 'computer')) $icon = 'fa-laptop-code';
                elseif (str_contains($t, 'co-curricular') || str_contains($t, 'co curricular')) $icon = 'fa-users';
            @endphp
            <li>
                <i class="fas {{ $icon }}" style="color:#1A5D3B; margin-right:8px;"></i>
                {{ $item }}
            </li>
            @endforeach
        </ul>
    </section>
    @endif

    @if(!empty($about->decoded_highlights))
    <!-- Highlights -->
    <section class="highlights">
        <h2>Highlights</h2>
        <ul>
            @foreach($about->decoded_highlights as $highlight)
            @php
                $t = strtolower($highlight);
                $icon = 'fa-star';
                if (str_contains($t, 'quality')) $icon = 'fa-award';
                elseif (str_contains($t, 'teacher')) $icon = 'fa-chalkboard-teacher';
                elseif (str_contains($t, 'community')) $icon = 'fa-handshake';
                elseif (str_contains($t, 'technology') || str_contains($t, 'computer')) $icon = 'fa-laptop-code';
                elseif (str_contains($t, 'holistic') || str_contains($t, 'growth')) $icon = 'fa-seedling';
            @endphp
            <li>
                <i class="fas {{ $icon }}" style="color:#D4AF37; margin-right:8px;"></i>
                {{ $highlight }}
            </li>
            @endforeach
        </ul>
    </section>
    @endif

    @if(!empty($about->decoded_programs))
    <!-- Programs We Offer -->
    <section class="programs">
        <h2>Programs We Offer</h2>
        <ul>
            @foreach($about->decoded_programs as $program)
            @php
                $t = strtolower($program);
                $icon = 'fa-book-open';
                if (str_contains($t, 'islamic')) $icon = 'fa-book-open';
                elseif (str_contains($t, 'academic')) $icon = 'fa-graduation-cap';
                elseif (str_contains($t, 'computer')) $icon = 'fa-desktop';
                elseif (str_contains($t, 'co-curricular') || str_contains($t, 'co curricular')) $icon = 'fa-users';
            @endphp
            <li>
                <i class="fas {{ $icon }}" style="color:#1A5D3B; margin-right:8px;"></i>
                {{ $program }}
            </li>
            @endforeach
        </ul>
    </section>
    @endif

    @if($about->principal_message)
    <!-- Principal Message -->
    <section class="message">
        <h2>Message from the Head</h2>
        <div class="content">
            {{ $about->principal_message }}
        </div>
    </section>
    @endif

    <!-- Contact -->
    <section class="contact">
        <h2>Contact Us</h2>
        <div class="contact-info">
            @if($about->contact_address)
            <p><i class="fas fa-map-marker-alt"></i> {{ $about->contact_address }}</p>
            @endif
            @if($about->contact_phone)
            <p><i class="fas fa-phone"></i> {{ $about->contact_phone }}</p>
            @endif
            @if($about->contact_email)
            <p><i class="fas fa-envelope"></i> {{ $about->contact_email }}</p>
            @endif
        </div>
    </section>
</main>
@else
<div class="container py-5 text-center">
    <div class="alert alert-info">
        <h4>About page content is not available at the moment.</h4>
        <p class="mb-0">Please check back later or contact the administrator.</p>
    </div>
</div>
@endif

@endsection
