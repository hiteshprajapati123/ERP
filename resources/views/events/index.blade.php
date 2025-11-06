@extends('layouts.app', ['title' => 'Upcoming Events'])

@section('content')
    <style>
        /* Base Styles */
        :root {
            --primary: #1A5D3B;
            --primary-dark: #14422c;
            --accent: #D4AF37;
            --text: #2D3748;
            --text-light: #6B7280;
            --bg-light: #F8F9FA;
            --white: #FFFFFF;
            --shadow-sm: 0 2px 4px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px rgba(0,0,0,0.1);
            --shadow-lg: 0 10px 25px rgba(0,0,0,0.1);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Hero Section */
        .events-hero {
            background: linear-gradient(rgba(26, 93, 59, 0.9), rgba(26, 93, 59, 0.8)), 
                        url('https://images.unsplash.com/photo-1519817650390-64a93db51149?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            padding: 120px 0 100px;
            color: var(--white);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .events-hero::before {
            content: '';
            position: absolute;
            bottom: -50px;
            left: 0;
            right: 0;
            height: 100px;
            background: var(--bg-light);
            transform: skewY(-3deg);
            transform-origin: top left;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 20px;
            position: relative;
            z-index: 1;
        }

        .hero-title {
            font-size: 3.25rem;
            font-weight: 800;
            margin: 0 0 1rem;
            line-height: 1.2;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .hero-subtitle {
            font-size: 1.25rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto 2rem;
            line-height: 1.6;
        }

        /* CTA Button */
        .cta-button {
            display: inline-flex;
            align-items: center;
            background: var(--white);
            color: var(--primary);
            padding: 14px 32px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
            box-shadow: 0 4px 15px rgba(26, 93, 59, 0.2);
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(26, 93, 59, 0.3);
        }

        .cta-button i {
            margin-left: 10px;
            transition: transform 0.3s ease;
        }

        .cta-button:hover i {
            transform: translateX(5px);
        }

        /* Events Grid */
        .events-section {
            padding: 80px 0;
            background: var(--bg-light);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .section-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-title {
            font-size: 2.25rem;
            color: var(--primary);
            margin: 0 0 1rem;
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--accent);
            border-radius: 2px;
        }

        .section-description {
            color: var(--text-light);
            max-width: 700px;
            margin: 0 auto;
            font-size: 1.1rem;
            line-height: 1.7;
        }

        .events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .event-card {
            background: var(--white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .event-image-container {
            height: 220px;
            overflow: hidden;
            position: relative;
        }

        .event-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.7s ease;
        }

        .event-card:hover .event-image {
            transform: scale(1.05);
        }

        .event-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(0,0,0,0.7);
            color: var(--white);
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            backdrop-filter: blur(5px);
            display: flex;
            align-items: center;
        }

        .event-badge i {
            margin-right: 6px;
            color: var(--accent);
        }

        .featured-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: var(--accent);
            color: var(--white);
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            z-index: 2;
            display: flex;
            align-items: center;
        }

        .featured-badge i {
            margin-right: 6px;
        }

        .event-content {
            padding: 25px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .event-title {
            font-size: 1.4rem;
            color: var(--primary);
            margin: 0 0 12px;
            line-height: 1.4;
        }

        .event-title a {
            color: inherit;
            text-decoration: none;
            transition: color 0.2s;
        }

        .event-title a:hover {
            color: var(--accent);
        }

        .event-meta {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            color: var(--text-light);
            font-size: 0.95rem;
        }

        .event-meta i {
            color: var(--accent);
            margin-right: 8px;
            width: 20px;
            text-align: center;
        }

        .event-description {
            color: var(--text-light);
            margin: 0 0 20px;
            line-height: 1.6;
            flex: 1;
        }

        .event-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 20px;
            border-top: 1px solid #eee;
            margin-top: auto;
        }

        .event-category {
            background: rgba(26, 93, 59, 0.1);
            color: var(--primary);
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .read-more {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            transition: color 0.2s;
        }

        .read-more:hover {
            color: var(--accent);
        }

        .read-more i {
            margin-left: 8px;
            transition: transform 0.3s ease;
        }

        .read-more:hover i {
            transform: translateX(4px);
        }

        /* No Events */
        .no-events {
            text-align: center;
            padding: 60px 20px;
            background: var(--white);
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
            max-width: 600px;
            margin: 0 auto;
        }

        .no-events i {
            font-size: 3.5rem;
            color: #E5E7EB;
            margin-bottom: 20px;
        }

        .no-events h3 {
            color: var(--text);
            margin: 0 0 10px;
            font-size: 1.5rem;
        }

        .no-events p {
            color: var(--text-light);
            margin: 0;
            line-height: 1.6;
        }

        /* Material-UI Style Pagination */
        .mui-pagination {
            display: flex;
            justify-content: center;
            margin: 2rem 0;
        }

        .pagination {
            display: flex;
            padding: 0;
            list-style: none;
            align-items: center;
            margin: 0;
        }

        .page-item {
            margin: 0 4px;
        }

        .page-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 32px;
            height: 32px;
            padding: 0 8px;
            border: 1px solid rgba(0, 0, 0, 0.23);
            background-color: transparent;
            color: rgba(0, 0, 0, 0.87);
            border-radius: 4px;
            font-size: 0.875rem;
            font-weight: 400;
            line-height: 1.43;
            text-align: center;
            text-decoration: none;
            transition: all 0.2s ease-in-out;
            cursor: pointer;
        }

        .page-item:first-child .page-link,
        .page-item:last-child .page-link {
            border-radius: 4px;
        }

        .page-item:not(:first-child) {
            margin-left: 8px;
        }

        .page-link:hover {
            background-color: rgba(0, 0, 0, 0.04);
        }

        .page-item.active .page-link {
            background-color: #1976d2;
            color: #fff;
            border-color: #1976d2;
        }

        .page-item.disabled .page-link {
            opacity: 0.5;
            cursor: not-allowed;
            background-color: transparent;
            color: rgba(0, 0, 0, 0.6);
        }

        .page-link i {
            font-size: 1.25rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
            }

            .events-grid {
                grid-template-columns: 1fr;
            }

            .event-card {
                max-width: 100%;
            }
        }

        @media (max-width: 480px) {
            .hero-title {
                font-size: 2rem;
            }

            .events-grid {
                grid-template-columns: 1fr;
            }

            .pagination {
                flex-wrap: nowrap;
                overflow-x: auto;
                padding-bottom: 8px;
                -webkit-overflow-scrolling: touch;
            }
            
            .pagination::-webkit-scrollbar {
                display: none;
            }
            
            .pagination {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
            
            .page-item {
                flex-shrink: 0;
            }
        }
        
    </style>

    <!-- Hero Section -->
    <section class="events-hero">
        <div class="hero-content">
            <h1 class="hero-title">Upcoming Events</h1>
            <p class="hero-subtitle">Join our community gatherings, workshops, and spiritual programs</p>
            <a href="#upcoming-events" class="cta-button">
                Explore Events <i class="fas fa-arrow-down"></i>
            </a>
        </div>
    </section>

    <!-- Upcoming Events Section -->
    <section id="upcoming-events" class="events-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Our Upcoming Events</h2>
                <p class="section-description">Discover and participate in our upcoming events designed to enrich your spiritual journey and community connection.</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success" role="alert" style="background: #D4EDDA; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 30px; border-left: 4px solid #28A745;">
                    {{ session('success') }}
                </div>
            @endif

            @if($events->count() > 0)
                <div class="events-grid">
                    @foreach($events as $event)
                        <article class="event-card">
                            <div class="event-image-container">
                                <img src="{{ $event->image_url ?? 'https://source.unsplash.com/random/600x400?islamic,event' }}" 
                                    alt="{{ $event->title }}" 
                                    class="event-image">
                                
                                @if($event->event_date)
                                    <div class="event-badge">
                                        <i class="far fa-calendar"></i> {{ $event->event_date->format('d M Y') }}
                                    </div>
                                @endif
                                
                                @if($event->is_featured)
                                    <div class="featured-badge">
                                        <i class="fas fa-star"></i> Featured
                                    </div>
                                @endif
                            </div>
                            
                            <div class="event-content">
                                <h3 class="event-title">
                                    <a href="{{ route('events.show', $event->slug) }}">{{ $event->title }}</a>
                                </h3>
                                
                                @if($event->location)
                                    <div class="event-meta">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span>{{ $event->location }}</span>
                                    </div>
                                @endif
                                
                                <p class="event-description">
                                    {{ Str::limit($event->description, 120) }}
                                </p>
                                
                                <div class="event-footer">
                                    <span class="event-category">
                                        {{ $event->registration_required ? 'Registration Required' : 'Open to All' }}
                                    </span>
                                    <a href="{{ route('events.show', $event->slug) }}" class="read-more">
                                        View Details <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="pagination-container" style="margin-top: 3rem; text-align: center;">
                    {{ $events->onEachSide(1)->links('vendor.pagination.custom') }}
                </div>
            @else
                <div class="no-events">
                    <i class="far fa-calendar-check"></i>
                    <h3>No Upcoming Events</h3>
                    <p>There are no upcoming events scheduled at the moment. Please check back later for updates on our future events and programs.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Contact CTA -->
    <section style="background: linear-gradient(135deg, rgba(26, 93, 59, 0.1) 0%, rgba(255, 255, 255, 0.9) 100%);
        padding: 80px 0;
        border-top: 1px solid #E5E7EB;
        position: relative;
        overflow: hidden;
        ">
        <div class="container" style="text-align: center; position: relative; z-index: 2;">
            <div style="background: white; padding: 50px 30px; border-radius: 16px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05); max-width: 800px; margin: 0 auto;">
                <h3 style="font-size: 2rem; color: var(--primary); margin-bottom: 20px; font-weight: 700;">Have Questions About Our Events?</h3>
                <p style="color: var(--text-light); max-width: 600px; margin: 0 auto 30px; line-height: 1.7; font-size: 1.1rem;">Our team is here to help you with any questions about our events, registration, or anything else you'd like to know.</p>
                <a href="{{ route('contact') }}" 
                    class="cta-button" 
                    style="background: var(--primary); 
                           color: white; padding: 14px 36px; 
                           font-size: 1.1rem; border-radius: 50px; 
                           text-decoration: none; display: inline-flex; 
                           align-items: center; transition: all 0.3s ease; 
                           box-shadow: 0 4px 15px rgba(26, 93, 59, 0.2);">
                           Contact Us <i class="fas fa-envelope ms-3"></i>
                </a>
            </div>
        </div>
        <!-- Decorative elements -->
        <div style="position: absolute; top: -100px; right: -100px; width: 300px; height: 300px; border-radius: 50%; background: rgba(212, 175, 55, 0.1); z-index: 1;"></div>
        <div style="position: absolute; bottom: -50px; left: -50px; width: 200px; height: 200px; border-radius: 50%; background: rgba(26, 93, 59, 0.1); z-index: 1;"></div>
    </section>

@endsection
