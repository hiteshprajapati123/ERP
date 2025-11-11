@extends('layouts.app', ['title' => 'Welcome'])

@section('content')
    <!-- Swiper Styles -->
    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />

    <style>
        /* Mobile-first approach */
        main {
            margin-top: 60px;
        }
        
        /* Desktop styles */
        @media (min-width: 992px) {
            main {
                margin-top: 90px;
            }
        }
        
        .swiper {
            width: 100%;
            height: 85vh;
        }

        .swiper-slide {
            position: relative;
            background-position: center;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }

        .swiper-slide::after {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
        }

        .slide-content {
            position: relative;
            z-index: 10;
            text-align: center;
            color: #fff;
            max-width: 800px;
            padding: 20px;
        }

        .slide-content h1 {
            font-size: 2.5rem;
            font-weight: 700;
        }

        .slide-content p {
            font-size: 1.2rem;
            margin-top: 10px;
        }

        @media (max-width: 768px) {
            .swiper {
                height: 60vh;
            }

            .slide-content h1 {
                font-size: 1.5rem;
            }

            .slide-content p {
                font-size: 1rem;
            }
        }

        /* Hover Effects */
        .notice-card-wrapper {
            transition: transform 0.3s ease;
        }
        
        .notice-card {
            transition: all 0.3s ease;
        }
        
        .notice-card-wrapper:hover .notice-card {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
            border-color: #e0e0e0 !important;
        }
        
        .notice-card-wrapper:hover .notice-card .card-header {
            transition: background-color 0.3s ease;
        }
        
        .notice-card:hover .card-header {
            background-color: #1a7a4a !important;
        }
        
        .view-all-card-wrapper:hover .view-all-card {
            transform: translateY(-5px);
            border-color: #1A5D3B !important;
            background-color: #f8f9fa;
        }
        
        .view-all-card-wrapper:hover .arrow-icon {
            transform: translateX(5px);
        }
        
        .view-all-card-wrapper:hover .view-all-card::before {
            opacity: 0.1;
        }
        
        .arrow-icon {
            transition: transform 0.3s ease;
        }
        
        /* New styles for attachments */
        .notice-card a {
            transition: all 0.2s ease;
            border-radius: 4px;
            padding: 4px 8px;
        }
        
        .notice-card a:hover {
            background-color: rgba(26, 93, 59, 0.1);
            text-decoration: none;
        }
        
        .notice-card a i {
            transition: transform 0.2s ease;
        }
        
        .notice-card a:hover i {
            transform: translateX(2px);
        }
        
        /* File type icons */
        .file-icon {
            margin-right: 8px;
            font-size: 1.2em;
        }
        
        .file-item {
            transition: all 0.2s ease;
            border-radius: 4px;
        }
        
        .file-item:hover {
            background-color: #f8f9fa;
            border-color: #1A5D3B !important;
        }

        @media (max-width: 768px) {
                .notice-card-wrapper, .view-all-card-wrapper {
                    flex: 0 0 100% !important;
                    max-width: 100% !important;
                    margin-bottom: 15px !important;
                }
                .notice-card h3 {
                    font-size: 16px !important;
                }
                .notice-card p {
                    font-size: 14px !important;
                }
            }
            @media (min-width: 769px) and (max-width: 1024px) {
                .notice-card-wrapper, .view-all-card-wrapper {
                    flex: 0 0 50% !important;
                    max-width: 50% !important;
                }
            }

            /* Desktop styles (768px and up) */
            @media (min-width: 768px) {
                .about-container {
                    flex-wrap: nowrap !important;
                }
                
                .about-image {
                    flex: 0 0 50% !important;
                    max-width: 50% !important;
                    padding: 0 15px !important;
                    order: 2 !important; /* Image on the right */
                }
                
                .about-text {
                    flex: 0 0 50% !important;
                    max-width: 50% !important;
                    padding: 0 15px !important;
                    order: 1 !important; /* Text on the left */
                }
                
                /* Adjust spacing for desktop */
                section {
                    padding: 100px 0 !important;
                }
                
                h2 {
                    font-size: 36px !important;
                    margin-bottom: 20px !important;
                }
            }
            
            /* Mobile styles */
            @media (max-width: 767px) {
                .about-container > div {
                    padding: 0 15px 20px !important;
                }
                
                .about-image {
                    order: 1 !important; /* Image first on mobile */
                    padding-bottom: 30px !important;
                }
                
                .about-text {
                    order: 2 !important; /* Text second on mobile */
                }
            }

            @media (max-width: 768px) {
                .event-card {
                    margin-bottom: 30px;
                }
                
                .event-card:last-child {
                    margin-bottom: 0;
                }
                
                h2 {
                    font-size: 28px !important;
                }
            }
            
            a:hover i.fa-arrow-right {
                transform: translateX(5px) !important;
            }

            .events-container {
                display: flex;
                flex-wrap: wrap;
                gap: 24px;
                justify-content: center;
                margin: 0 auto;
                max-width: 1200px;
                padding: 0 15px;
            }
            .event-card {
                background: #ffffff;
                border-radius: 12px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
                width: 100%;
                max-width: 360px;
                overflow: hidden;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }
            .event-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            }
            .event-image {
                width: 100%;
                height: 200px;
                object-fit: cover;
                border-radius: 12px 12px 0 0;
            }
            .event-content {
                padding: 20px;
            }
            .event-date {
                font-size: 14px;
                color: #6b7280;
                margin-bottom: 8px;
                display: flex;
                align-items: center;
            }
            .event-date i {
                color: #D4AF37;
                margin-right: 6px;
            }
            .event-title {
                font-size: 20px;
                font-weight: 700;
                color: #1f2937;
                margin: 0 0 12px 0;
                line-height: 1.3;
            }
            .event-description {
                color: #4b5563;
                font-size: 14px;
                line-height: 1.5;
                margin-bottom: 16px;
                display: -webkit-box;
                -webkit-line-clamp: 3;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
            .event-footer {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding-top: 16px;
                border-top: 1px solid #f3f4f6;
            }
            .event-tag {
                background: #f3f4f6;
                color: #4b5563;
                padding: 4px 12px;
                border-radius: 20px;
                font-size: 12px;
                font-weight: 500;
            }
            .event-link {
                color: #D4AF37;
                font-size: 14px;
                font-weight: 600;
                text-decoration: none;
                display: flex;
                align-items: center;
                transition: color 0.2s;
            }
            .event-link:hover {
                color: #B08D2E;
            }
            .event-link i {
                margin-left: 6px;
                transition: transform 0.2s;
            }
            .event-link:hover i {
                transform: translateX(3px);
            }
            .featured-badge {
                position: absolute;
                top: 15px;
                left: 15px;
                background: #D4AF37;
                color: white;
                padding: 4px 12px;
                border-radius: 20px;
                font-size: 12px;
                font-weight: 600;
                z-index: 2;
            }
            .event-image-container {
                position: relative;
                height: 200px;
                overflow: hidden;
            }
            .event-image-container img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.5s ease;
            }
            .event-card:hover .event-image-container img {
                transform: scale(1.05);
            }
            @media (max-width: 768px) {
                .events-container {
                    flex-direction: column;
                    align-items: center;
                }
                .event-card {
                    max-width: 100%;
                }
            }

            .gallery-preview-item {
                position: relative;
                overflow: hidden;
                border-radius: 12px;
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .gallery-preview-item:hover {
                transform: translateY(-5px);
                box-shadow: 0 15px 40px rgba(0,0,0,0.15) !important;
            }

            .gallery-preview-item:hover .gallery-preview-overlay {
                opacity: 1;
            }

            .gallery-preview-item:hover img {
                transform: scale(1.05);
            }

            .gallery-preview-item:hover .gallery-preview-overlay h3,
            .gallery-preview-item:hover .gallery-preview-overlay p {
                transform: translateY(0);
            }

            @media (max-width: 768px) {
                .gallery-grid {
                    grid-template-columns: repeat(2, 1fr) !important;
                    gap: 15px !important;
                }
            }

            @media (max-width: 480px) {
                .gallery-grid {
                    grid-template-columns: 1fr !important;
                }
            }
    </style>

    <!-- hero section -->
        @if(isset($slides) && $slides->count() > 0)
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach($slides as $slide)
                    <div class="swiper-slide" style="background-image:url('{{ $slide->image_url }}')">
                        <div class="slide-content">
                            <h1>{{ $slide->title }}</h1>
                            @if($slide->description)
                                <p>{{ $slide->description }}</p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        @else
            <!-- Fallback in case no slides are found -->
            <div style="background: #f8f9fa; padding: 100px 0; text-align: center;">
                <h2>Welcome to Our Madarsa</h2>
                <p>Empowering Knowledge with Faith & Wisdom</p>
            </div>
        @endif
    <!-- hero end -->

    <!-- About Section -->
        @if($aboutSection)
        <section id="about-section" style="background: linear-gradient(135deg, #f8f9fa 0%, #f0f4f8 100%); padding: 80px 0; position: relative; overflow: hidden;">
            <!-- Decorative Elements -->
            <div style="position: absolute; top: -50px; right: -50px; width: 300px; height: 300px; background: rgba(26, 93, 59, 0.05); border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;"></div>
            <div style="position: absolute; bottom: -100px; left: -50px; width: 400px; height: 400px; background: rgba(212, 175, 55, 0.1); border-radius: 50%;"></div>
            
            <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px; position: relative;">
                <!-- Header -->
                <div style="text-align: center; margin-bottom: 60px; position: relative;">
                    <h2 style="font-size: 42px; color: #1A5D3B; margin: 15px 0 20px; font-weight: 700; position: relative; display: inline-block;">
                        {{ $aboutSection->title }}
                        <span style="content: ''; position: absolute; bottom: -10px; left: 50%; transform: translateX(-50%); width: 60px; height: 3px; background: #D4AF37; transition: all 0.3s ease;"></span>
                    </h2>
                    <p style="max-width: 700px; margin: 0 auto; color: #5a7184; font-size: 16px; line-height: 1.7; transition: all 0.3s ease;">
                        {{ $aboutSection->description }}
                    </p>
                </div>

                <!-- Main Content -->
                <div class="about-container" style="display: flex; flex-wrap: wrap; margin: 0 -15px 50px; position: relative; z-index: 2; align-items: stretch;">
                    <!-- Image - Full width on mobile, 50% on desktop -->
                    <div class="about-image" style="flex: 0 0 100%; max-width: 100%; padding: 0 15px 30px; box-sizing: border-box; order: 1;">
                        <div style="position: relative; border-radius: 12px; overflow: hidden; box-shadow: 0 15px 30px rgba(0,0,0,0.1); transition: all 0.3s ease; height: 100%;">
                            <img 
                                src="{{ $aboutSection->image_url ?? 'https://via.placeholder.com/800x500?text=Madrasa+Campus' }}" 
                                alt="{{ $aboutSection->title }}" 
                                style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;"
                                onmouseover="this.style.transform='scale(1.03)'; this.parentNode.style.boxShadow='0 20px 40px rgba(0,0,0,0.15)'" 
                                onmouseout="this.style.transform='scale(1)'; this.parentNode.style.boxShadow='0 15px 30px rgba(0,0,0,0.1)'"
                                loading="lazy"
                            >
                        </div>
                    </div>

                    <!-- Text Content - Full width on mobile, 50% on desktop -->
                    <div class="about-text" style="flex: 0 0 100%; max-width: 100%; padding: 0 15px; box-sizing: border-box; order: 2;">
                        <div style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border: 1px solid rgba(0,0,0,0.05); height: 100%;">
                            <h3 style="font-size: 28px; color: #1A5D3B; margin-bottom: 20px; position: relative; padding-bottom: 15px;">
                                {{ $aboutSection->welcome_title }}
                                <span style="position: absolute; bottom: 0; left: 0; width: 50px; height: 3px; background: #D4AF37; transition: width 0.3s ease;"></span>
                            </h3>
                            
                            <p style="color: #5a7184; line-height: 1.8; margin-bottom: 25px; font-size: 15px;">
                                {{ $aboutSection->welcome_content }}
                            </p>
                            
                            <div style="margin: 30px 0;">
                                <div style="display: flex; margin-bottom: 20px; padding: 15px; border-radius: 8px; transition: all 0.3s ease; background: #f8f9fa;" 
                                    onmouseover="this.style.background='#f1f7f1'; this.style.transform='translateX(5px)';" 
                                    onmouseout="this.style.background='#f8f9fa'; this.style.transform='translateX(0)';">
                                    <div style="background: rgba(26, 93, 59, 0.1); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px; color: #1A5D3B; font-size: 18px; flex-shrink: 0; transition: all 0.3s ease;">
                                        <i class="fas fa-book-open"></i>
                                    </div>
                                    <div>
                                        <h4 style="margin: 0 0 8px 0; color: #1A5D3B; font-size: 16px; font-weight: 600; transition: all 0.3s ease;">{{ $aboutSection->quote_1_text }}</h4>
                                        <p style="margin: 0; color: #6c757d; font-size: 14px; line-height: 1.6; transition: all 0.3s ease;">{{ $aboutSection->quote_1_author }}</p>
                                    </div>
                                </div>
                                
                                <div style="display: flex; padding: 15px; border-radius: 8px; transition: all 0.3s ease; background: #f8f9fa;"
                                    onmouseover="this.style.background='#f1f7f1'; this.style.transform='translateX(5px)';" 
                                    onmouseout="this.style.background='#f8f9fa'; this.style.transform='translateX(0)';">
                                    <div style="background: rgba(26, 93, 59, 0.1); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px; color: #1A5D3B; font-size: 18px; flex-shrink: 0; transition: all 0.3s ease;">
                                        <i class="fas fa-heart"></i>
                                    </div>
                                    <div>
                                        <h4 style="margin: 0 0 8px 0; color: #1A5D3B; font-size: 16px; font-weight: 600; transition: all 0.3s ease;">{{ $aboutSection->quote_2_text }}</h4>
                                        <p style="margin: 0; color: #6c757d; font-size: 14px; line-height: 1.6; transition: all 0.3s ease;">{{ $aboutSection->quote_2_author }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <a href="{{ $aboutSection->button_link }}" style="display: inline-flex; align-items: center; background: #1A5D3B; color: white; padding: 12px 28px; text-decoration: none; border-radius: 50px; margin-top: 10px; font-weight: 500; transition: all 0.3s ease; border: 2px solid #1A5D3B;"
                            onmouseover="this.style.background='#14422c'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 5px 15px rgba(26, 93, 59, 0.3)';" 
                            onmouseout="this.style.background='#1A5D3B'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                                {{ $aboutSection->button_text }}
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" style="margin-left: 8px; transition: transform 0.3s ease;">
                                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif
    <!-- About Section End -->

    <!-- Notice Board Section -->
        @php
            $recentNotices = \App\Models\Notice::recent(2)->get();
        @endphp

        <section style="padding: 60px 0; background-color: #f8f9fa; position: relative;">
            <div style="max-width: 1200px; margin: 0 auto; padding: 0 15px;">
                <div style="text-align: center; margin-bottom: 30px;">
                    <h2 style="font-size: 32px; color: #1A5D3B; margin: 0 0 10px; font-weight: 700; position: relative; display: inline-block;">
                        Notice Board
                        <span style="position: absolute; bottom: -10px; left: 50%; transform: translateX(-50%); width: 60px; height: 3px; background: #D4AF37;"></span>
                    </h2>
                </div>

                <div style="display: flex; flex-wrap: wrap; margin: 0 -10px;">
                    @forelse($recentNotices as $notice)
                        <div class="notice-card-wrapper" style="flex: 0 0 33.333%; max-width: 33.333%; padding: 0 10px; margin-bottom: 20px; box-sizing: border-box;">
                            <div class="notice-card" style="background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.05); height: 100%; border: 1px solid #f0f0f0;">
                                <div class="card-header" style="background: #1A5D3B; padding: 15px; color: white; font-weight: 600; font-size: 16px; position: relative; z-index: 1;">
                                    @switch($notice->type)
                                        @case('event')
                                            <i class="bi bi-calendar-event me-2"></i> Event
                                            @break
                                        @case('exam')
                                            <i class="bi bi-file-earmark-text me-2"></i> Exam
                                            @break
                                        @case('course_material')
                                            <i class="bi bi-journal-bookmark me-2"></i> Course Material
                                            @break
                                        @default
                                            <i class="bi bi-megaphone me-2"></i> Announcement
                                    @endswitch
                                    | {{ $notice->notice_date->format('d M Y') }}
                                </div>
                                <div style="padding: 20px;">
                                    <h3 style="margin: 0 0 15px 0; color: #2c3e50; font-size: 18px; font-weight: 600;">
                                        {{ \Illuminate\Support\Str::limit($notice->title, 50) }}
                                    </h3>
                                    <p style="margin: 0 0 15px 0; color: #6c757d; font-size: 15px; line-height: 1.6;">
                                        {{ \Illuminate\Support\Str::limit($notice->description, 100) }}
                                    </p>
                                    <div style="margin-top: 15px; border-top: 1px solid #eee; padding-top: 15px;">
                                        <a href="{{ route('notices.show', $notice) }}" style="display: inline-flex; align-items: center; color: #1A5D3B; text-decoration: none; font-weight: 500;">
                                            <i class="bi bi-arrow-right me-2"></i> Read More
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p>No notices available at the moment.</p>
                        </div>
                    @endforelse

                    <!-- View All Notices Card -->
                    <a href="{{ route('notices.index') }}" class="view-all-card-wrapper" style="flex: 0 0 33.333%; max-width: 33.333%; padding: 0 10px; margin-bottom: 20px; box-sizing: border-box; text-decoration: none; display: block;">
                        <div class="view-all-card" style="background: white; border: 2px dashed #1A5D3B; border-radius: 8px; overflow: hidden; height: 100%; display: flex; align-items: center; justify-content: center; cursor: pointer; position: relative;">
                            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(135deg, rgba(26, 93, 59, 0.1) 0%, rgba(26, 93, 59, 0) 100%); opacity: 0; transition: all 0.3s ease;"></div>
                            <div style="text-align: center; padding: 30px 20px; width: 100%;">
                                <div style="width: 60px; height: 60px; background: #e9f7ef; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
                                    <i class="bi bi-arrow-right arrow-icon" style="font-size: 24px; color: #1A5D3B; position: relative; z-index: 1;"></i>
                                </div>
                                <h3 style="margin: 0 0 10px 0; color: #1A5D3B; font-size: 18px; font-weight: 600;">View All Notices</h3>
                                <p style="margin: 0; color: #6c757d; font-size: 14px;">Click to see all notices and announcements</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </section>
    <!-- Notice Board End -->

    <!-- Upcoming Events Section -->
        @php
            $upcomingEvents = \App\Models\Event::upcoming()->orderBy('event_date', 'asc')->take(3)->get();
        @endphp

        <section style="padding: 80px 0; background: linear-gradient(to bottom, #ffffff 0%, #f9fafb 100%);">
            <div style="max-width: 1200px; margin: 0 auto; padding: 0 15px;">
                <div style="text-align: center; margin-bottom: 64px; max-width: 768px; margin-left: auto; margin-right: auto;">
                    <span style="color: #D4AF37; font-weight: 600; font-size: 14px; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 16px;">Upcoming Events</span>
                    <h2 style="font-size: 36px; font-weight: 700; color: #111827; margin: 0 0 24px 0; position: relative; padding-bottom: 20px;">
                        Join Our Community Events
                        <span style="position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); width: 80px; height: 4px; background: #D4AF37; border-radius: 2px;"></span>
                    </h2>
                    <p style="color: #4b5563; font-size: 18px; line-height: 1.7; margin: 0;">
                        Discover and participate in our upcoming events. Connect with the community and enrich your spiritual journey.
                    </p>
                </div>

                @if($upcomingEvents->count() > 0)
                <div class="events-container">
                    @foreach($upcomingEvents as $event)
                    <div class="event-card">
                        <div class="event-image-container">
                            <img 
                                src="{{ $event->image_url ?? 'https://images.unsplash.com/photo-1505373876331-8d30b8a4fca3?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80' }}" 
                                alt="{{ $event->title }}"
                                loading="lazy"
                            >
                            @if($event->is_featured)
                            <span class="featured-badge">
                                <i class="fas fa-star"></i> Featured
                            </span>
                            @endif
                        </div>
                        <div class="event-content">
                            <div class="event-date">
                                <i class="far fa-calendar-alt"></i>
                                {{ $event->event_date ? $event->event_date->format('F j, Y') : 'Date TBD' }}
                            </div>
                            <h3 class="event-title">
                                <a href="{{ route('events.show', $event->slug) }}" style="color: inherit; text-decoration: none;">
                                    {{ $event->title }}
                                </a>
                            </h3>
                            <p class="event-description">
                                {{ Str::limit($event->description, 150) }}
                            </p>
                            <div class="event-footer">
                                <span class="event-tag">
                                    <i class="fas {{ $event->registration_required ? 'fa-user-plus' : 'fa-door-open' }}"></i>
                                    {{ $event->registration_required ? 'Registration Open' : 'Registration Closed' }}
                                </span>
                                <a href="{{ route('events.show', $event->slug) }}" class="event-link">
                                    View Details
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div style="text-align: center; margin-top: 3rem;">
                    <a href="{{ route('events.index') }}" 
                       style="display: inline-flex; 
                              align-items: center; 
                              background: linear-gradient(to right, #1a5d3b, #166534); 
                              color: white; 
                              font-weight: 500; 
                              border-radius: 9999px; 
                              padding: 12px 32px; 
                              text-decoration: none; 
                              box-shadow: 0 4px 6px rgba(0,0,0,0.1); 
                              transition: all 0.3s ease;"
                       onmouseover="this.style.transform='translateY(-2px) scale(1.02)'; this.style.boxShadow='0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05)'"
                       onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 4px 6px rgba(0,0,0,0.1)'"
                       onfocus="this.style.outline='2px solid #1a5d3b'; this.style.outlineOffset='2px'">
                        View All Events
                        <i class="fas fa-arrow-circle-right" style="margin-left: 8px; font-size: 18px;"></i>
                    </a>
                </div>
                @endif
            </div>
        </section>
    <!-- Upcoming Events End -->

    <!-- Photo Gallery Section -->
        <section style="padding: 80px 0; background: linear-gradient(135deg, #f8f9fa 0%, #f0f4f8 100%); position: relative; overflow: hidden;">
            <!-- Decorative Elements -->
            <div style="position: absolute; top: -50px; right: -50px; width: 300px; height: 300px; background: rgba(26, 93, 59, 0.05); border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;"></div>
            <div style="position: absolute; bottom: -100px; left: -50px; width: 400px; height: 400px; background: rgba(212, 175, 55, 0.1); border-radius: 50%;"></div>
            
            <div style="max-width: 1200px; margin: 0 auto; padding: 0 15px; position: relative; z-index: 1;">
                <div style="text-align: center; margin-bottom: 40px;">
                    <h2 style="font-size: 36px; color: #1A5D3B; margin: 0 0 15px; font-weight: 700; position: relative; display: inline-block;">
                        Glimpses of Our Institute
                        <span style="position: absolute; bottom: -10px; left: 50%; transform: translateX(-50%); width: 60px; height: 3px; background: #D4AF37;"></span>
                    </h2>
                    <p style="color: #555; font-size: 18px; max-width: 700px; margin: 0 auto 20px; line-height: 1.6;">
                        Explore the vibrant activities and beautiful moments from our institute through our photo collection
                    </p>
                    <div id="gallery-container" class="gallery-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 25px; margin: 0 auto; width: 100%;">
                        <!-- Gallery items will be loaded here by JavaScript -->
                        <div class="text-center py-10">
                            <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-[#1A5D3B] mx-auto"></div>
                            <p class="mt-2 text-gray-600">Loading gallery...</p>
                        </div>
                    </div>
                    
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            fetch('/api/gallery/featured')
                                .then(response => response.json())
                                .then(galleryItems => {
                                    const galleryContainer = document.getElementById('gallery-container');
                                    galleryContainer.innerHTML = ''; // Clear loading message
                                    
                                    galleryItems.forEach(item => {
                                        const galleryItem = `
                                            <div class="gallery-preview-item group" style="position: relative; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.08); transition: all 0.4s ease; aspect-ratio: 1/1;">
                                                <img src="${item.image_url}" 
                                                    alt="${item.image_alt}" 
                                                    style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease;"
                                                    class="group-hover:scale-105 transition-transform duration-500">
                                                <div class="gallery-preview-overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(to top, rgba(26, 93, 59, 0.9) 0%, rgba(26, 93, 59, 0.1) 60%); display: flex; flex-direction: column; justify-content: flex-end; padding: 20px; opacity: 0; transition: all 0.4s ease; color: white;">
                                                    <h3 style="margin: 0 0 5px; font-size: 18px; font-weight: 600; transform: translateY(20px); transition: transform 0.4s ease 0.1s;" class="group-hover:translate-y-0">${item.title}</h3>
                                                    <p style="margin: 0; font-size: 14px; opacity: 0.9; transform: translateY(20px); transition: transform 0.4s ease 0.15s;" class="group-hover:translate-y-0">${item.description}</p>
                                                </div>
                                            </div>
                                        `;
                                        galleryContainer.insertAdjacentHTML('beforeend', galleryItem);
                                    });
                                    
                                    // Add hover effects after items are loaded
                                    const galleryItemsEl = document.querySelectorAll('.gallery-preview-item');
                                    galleryItemsEl.forEach(item => {
                                        item.addEventListener('mouseenter', function() {
                                            this.querySelector('.gallery-preview-overlay').style.opacity = '1';
                                            this.querySelectorAll('h3, p').forEach(el => {
                                                el.style.transform = 'translateY(0)';
                                            });
                                        });
                                        
                                        item.addEventListener('mouseleave', function() {
                                            this.querySelector('.gallery-preview-overlay').style.opacity = '0';
                                            this.querySelectorAll('h3, p').forEach(el => {
                                                el.style.transform = 'translateY(20px)';
                                            });
                                        });
                                    });
                                })
                                .catch(error => {
                                    console.error('Error loading gallery:', error);
                                    document.getElementById('gallery-container').innerHTML = `
                                        <div class="col-span-3 text-center py-10">
                                            <p class="text-red-500">Failed to load gallery. Please try again later.</p>
                                        </div>
                                    `;
                                });
                        });
                    </script>

                    <div style="text-align: center; margin-top: 50px;">
                        <a href="{{ route('gallery') }}" 
                        style="display: inline-flex; align-items: center; background: #1A5D3B; color: white; padding: 14px 35px; border-radius: 50px; text-decoration: none; font-weight: 600; transition: all 0.3s ease; border: 2px solid #1A5D3B; font-size: 16px;"
                        onmouseover="this.style.background='#14422c'; this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 20px rgba(26, 93, 59, 0.25)';" 
                        onmouseout="this.style.background='#1A5D3B'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                            View Full Gallery
                            <i class="bi bi-arrow-right ms-2" style="transition: transform 0.3s ease;"></i>
                        </a>
                    </div>  
                </div>
            </div>
        </section>
    <!-- Photo Gallery End -->

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        // Swiper
        var swiper = new Swiper(".mySwiper", {
            loop: true,
            autoplay: {
                delay: 4000, // 4 seconds
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            effect: "slide",
            speed: 2000,
        });

         // Add hover effect for gallery items
         document.addEventListener('DOMContentLoaded', function() {
            const galleryItems = document.querySelectorAll('.gallery-preview-item');
            
            galleryItems.forEach(item => {
                item.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-8px)';
                    this.style.boxShadow = '0 15px 40px rgba(0,0,0,0.15)';
                    const overlay = this.querySelector('.gallery-preview-overlay');
                    if (overlay) {
                        overlay.style.opacity = '1';
                        const h3 = overlay.querySelector('h3');
                        const p = overlay.querySelector('p');
                        if (h3) h3.style.transform = 'translateY(0)';
                        if (p) p.style.transform = 'translateY(0)';
                    }
                });
                
                item.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = '0 10px 30px rgba(0,0,0,0.08)';
                    const overlay = this.querySelector('.gallery-preview-overlay');
                    if (overlay) {
                        overlay.style.opacity = '0';
                        const h3 = overlay.querySelector('h3');
                        const p = overlay.querySelector('p');
                        if (h3) h3.style.transform = 'translateY(20px)';
                        if (p) p.style.transform = 'translateY(20px)';
                    }
                });
            });
        });
    </script>
@endsection
