@extends('layouts.app', ['title' => $about->meta_title ?? 'About Us', 'meta_description' => $about->meta_description ?? '', 'meta_keywords' => $about->meta_keywords ?? ''])

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
    @if($about->banner_image)
    <!-- Banner Section -->
    <section class="banner mb-5">
        <img src="{{ $about->banner_image_url }}" alt="{{ $about->page_title }}" class="img-fluid w-100 rounded-3 shadow">
    </section>
    @endif
    
    <!-- Intro Section -->
    <section class="intro">
        <h2>{{ $about->page_title }}</h2>
        <div class="row">
            <div class="content">
                {!! $about->intro_content !!}
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
            {!! $about->history_content !!}
        </div>
    </section>
    @endif

    @if(!empty($about->decoded_what_we_offer))
    <!-- What We Offer -->
    <section class="what-we-offer">
        <h2>What We Offer</h2>
        <ul>
            @foreach($about->decoded_what_we_offer as $item)
            <li>{!! $item !!}</li>
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
            <li>{!! $highlight !!}</li>
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
            <li>{{ $program }}</li>
            @endforeach
        </ul>
    </section>
    @endif

    @if($about->principal_message)
    <!-- Principal Message -->
    <section class="message">
        <h2>Message from the {{ $about->principal_title ?? 'Head' }}</h2>
        <div class="row align-items-center">
            @if($about->principal_image)
            <div class="col-md-3 text-center mb-4 mb-md-0">
                <img src="{{ $about->principal_image_url }}" alt="{{ $about->principal_name ?? 'Principal' }}" class="img-fluid rounded-circle shadow" style="max-width: 200px;">
                @if($about->principal_name)
                <h4 class="mt-3 mb-0">{{ $about->principal_name }}</h4>
                @endif
                @if($about->principal_title)
                <p class="text-muted">{{ $about->principal_title }}</p>
                @endif
            </div>
            @endif
            <div class="{{ $about->principal_image ? 'col-md-9' : 'col-12' }}">
                <div class="content">
                    {!! $about->principal_message !!}
                </div>
            </div>
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
