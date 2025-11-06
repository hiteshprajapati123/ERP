<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Madarsa Nizamia Barkatia')</title>
    <link rel="shortcut icon" href="{{ asset('img/logo.jpeg') }}" type="image/jpeg">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @yield('styles')
    <style>
        /* Disable hover and focus effects on mobile header toggle */
        .main-header.d-lg-none .navbar-toggler:focus,
        .main-header.d-lg-none .navbar-toggler:hover {
            color: var(--primary-color) !important;
            outline: none !important;
            box-shadow: none !important;
        }

        :root {
            font-family: 'Inter', sans-serif;
            --primary-color: #2ecc71;
            --primary-light: #a5dfc7;
            --primary-dark: #27ae60;
            --secondary-color: #3498db;
            --dark-color: #2c3e50;
            --light-color: #f8f9fc;
            --header-text: #2c3e50;
            --header-bg: #f1f9f5;
        }
        
        /* Header Styles */
        .main-header {
            background: var(--header-bg);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid rgba(46, 204, 113, 0.2);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1030;
            padding: 0.4rem 0;
        }
    
        .main-header.d-lg-none .navbar {
            padding: 0;
        }
        
        .main-header.d-lg-none .navbar-toggler {
            padding: 0.25rem;
        }
        
        .main-header.d-lg-none .navbar-collapse {
            position: absolute;
            top: 100%;
            left: 0.75rem;
            right: 0.75rem;
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        
        @media (max-width: 991.98px) {
            main {
                margin-top: 60px;
            }
        }
        
        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--header-text) !important;
            transition: all 0.3s ease;
            line-height: 1.2;
            
            .school-name {
                text-align: left;
            }
            
            .small {
                font-size: 0.8rem;
                font-weight: 500;
                color: var(--primary-dark);
                opacity: 0.9;
            }
            
            &:hover {
                transform: translateY(-1px);
                .small {
                    color: var(--primary-color);
                }
            }
        }
        
        .nav-link {
            color: var(--header-text) !important;
            opacity: 0.9;
            font-weight: 600;
            padding: 0.5rem 1rem !important;
            margin: 0 0.25rem;
            transition: all 0.3s;
            border-radius: 0.35rem;
        }
        
        .nav-link:hover {
            color: var(--primary-dark) !important;
            background-color: rgba(46, 204, 113, 0.1);
            transform: translateY(-1px);
        }
        
        .nav-link.active {
            color: var(--primary-dark) !important;
            font-weight: 700;
            background-color: rgba(46, 204, 113, 0.1);
            border-bottom: 2px solid var(--primary-color);
        }
        
        /* Footer Styles */
        .main-footer {
            background: linear-gradient(135deg, var(--dark-color) 0%, #1a252f 100%);
            color: white;
            padding: 4rem 0 1.5rem;
            position: relative;
            overflow: hidden;
            margin-top: 3rem;
        }
        
        .main-footer:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        }
        
        .footer-heading {
            color: var(--primary-light);
            font-weight: 700;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 0.75rem;
            font-size: 1.25rem;
        }
        
        .footer-heading:after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-color), transparent);
            border-radius: 3px;
        }
        
        .footer-links {
            padding-left: 0;
            list-style: none;
        }
        
        .footer-links li {
            margin-bottom: 0.5rem;
            position: relative;
            padding-left: 1.25rem;
        }
        
        .footer-links li:before {
            content: '→';
            position: absolute;
            left: 0;
            color: var(--primary-color);
            transition: all 0.3s;
            opacity: 0;
        }
        
        .footer-links li:hover:before {
            opacity: 1;
            transform: translateX(5px);
        }
        
        .footer-links a {
            color: #d1d3e2;
            text-decoration: none;
            display: block;
            padding: 0.25rem 0;
            transition: all 0.3s;
            position: relative;
        }
        
        .footer-links a:hover {
            color: white;
            padding-left: 10px;
            text-decoration: none;
        }
        
        .social-links {
            display: flex;
            gap: 10px;
            margin-top: 1.5rem;
        }
        
        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            color: white;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .social-links a:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            z-index: 0;
            opacity: 0;
            transition: all 0.3s;
        }
        
        .social-links a i,
        .social-links a svg {
            position: relative;
            z-index: 1;
            transition: all 0.3s ease;
        }
        
        .social-links a:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .social-links a:hover:before {
            opacity: 1;
        }
        
        .copyright {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 1.5rem;
            margin-top: 3rem;
            text-align: center;
            color: #b7b9cc;
            font-size: 0.9rem;
            position: relative;
        }
        
        .copyright:before {
            content: '';
            position: absolute;
            top: -1px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--primary-color), transparent);
        }
        
        .btn-outline-light {
            color: var(--primary-dark);
            border-color: var(--primary-dark);
            font-weight: 600;
            position: relative;
            overflow: hidden;
            z-index: 1;
            transition: all 0.3s;
        }
        
        .btn-outline-light:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 100%;
            background-color: var(--primary-dark);
            transition: all 0.3s;
            z-index: -1;
        }
        
        .btn-outline-light:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(46, 204, 113, 0.3);
        }
        
        .btn-outline-light:hover:before {
            width: 100%;
        }
        
        /* Responsive Styles */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                background-color: var(--header-bg);
                padding: 1rem;
                border-radius: 0.35rem;
                margin-top: 0.5rem;
            }
        }
        
        /* Desktop Dropdown Styles */
        @media (min-width: 992px) {
            .dropdown-hover .dropdown-menu {
                display: block;
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease;
                margin-top: 0.5rem;
                border: none;
                box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.1);
                border-radius: 0.5rem;
                padding: 0.5rem 0;
                min-width: 220px;
                background: white;
                position: absolute;
                z-index: 1000;
            }
            
            .dropdown-hover:hover .dropdown-menu,
            .dropdown-hover .dropdown-menu.show {
                opacity: 1;
                visibility: visible;
                transform: translateY(0);
            }
        }
        
        /* Mobile view styles */
        @media (max-width: 991.98px) {
            .dropdown-hover {
                position: static;
            }
            
            .dropdown-hover .dropdown-menu {
                position: fixed;
                top: 0;
                right: -280px;
                width: 280px;
                height: 100%;
                margin: 0;
                padding: 0;
                background: #fff;
                box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1);
                transition: right 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                z-index: 1100;
                overflow-y: auto;
                display: block !important;
                border-radius: 0;
                visibility: hidden;
                border-left: 1px solid rgba(0, 0, 0, 0.1);
            }
            
            .dropdown-hover .dropdown-menu.show {
                right: 0 !important;
                visibility: visible;
            }
            
            
            .dropdown-hover .dropdown-item {
                padding: 1rem 1.5rem;
                color: #333 !important;
                border-bottom: 1px solid rgba(0, 0, 0, 0.05);
                font-size: 1rem;
                display: flex;
                align-items: center;
                transition: background-color 0.2s;
            }
            
            .dropdown-hover .dropdown-item i {
                margin-right: 0.75rem;
                font-size: 1.1rem;
                width: 24px;
                text-align: center;
            }
            
            .dropdown-hover .dropdown-item:hover {
                background: #f5f5f5;
                color: #000 !important;
            }
            
            /* Overlay styles */
            .dropdown-backdrop {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.2);
                z-index: 1050;
                opacity: 0;
                visibility: hidden;
                transition: opacity 0.3s ease;
            }
            
            /* Header for mobile menu */
            .dropdown-hover .dropdown-menu::before {
                content: 'Donation';
                display: block;
                padding: 1rem 1.5rem;
                font-weight: 600;
                color: #333;
                border-bottom: 1px solid rgba(0, 0, 0, 0.1);
                margin-bottom: 0.5rem;
                background: #f8f9fa;
            }
        }
        
        .dropdown-hover:hover .dropdown-menu,
        .dropdown-hover .dropdown-menu.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .dropdown-hover .dropdown-toggle::after {
            display: inline-block;
            margin-left: 0.3em;
            vertical-align: middle;
            content: "\f107";
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            border: none;
            transition: transform 0.2s ease;
        }
        
        .dropdown-hover .dropdown-toggle:hover::after {
            transform: translateY(2px);
        }
        
        .dropdown-item {
            padding: 0.5rem 1.5rem;
            transition: all 0.2s ease;
        }
        
        .dropdown-item:hover {
            background-color: #f8f9fa;
            padding-left: 1.75rem;
        }
    </style>
</head>
<body>
    <!-- Desktop Header -->
    <header class="main-header d-none d-lg-block">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <div class="d-flex align-items-center">
                        <div class="me-3" style="width: 50px; height: 50px; overflow: hidden; border-radius: 50%;">
                            <img src="{{ asset('img/logo.jpeg') }}" alt="Madarsa Nizamia Barkatia Logo" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div class="school-name">
                            <div class="fw-bold mb-0">Madarsa Nizamia</div>
                            <div class="small">Barkatia Mushtaqul Uloom</div>
                        </div>
                    </div>
                </a>
                
                <div class="d-flex align-items-center">
                    <ul class="navbar-nav me-auto mb-0 d-flex align-items-center" style="font-size: 0.9rem;">
                        <li class="nav-item d-flex align-items-center">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active fw-bold' : 'text-dark' }} px-2 py-1 d-inline-flex align-items-center" href="{{ route('home') }}">
                                <i class="fas fa-home me-1"></i> Home
                            </a>
                        </li>
                        <li class="nav-item d-flex align-items-center">
                            <a class="nav-link {{ request()->routeIs('about') ? 'active fw-bold' : 'text-dark' }} px-2 py-1 d-inline-flex align-items-center" href="{{ route('about') }}">
                                <i class="fas fa-info-circle me-1"></i> About
                            </a>
                        </li>
                        <li class="nav-item dropdown dropdown-hover">
                            <a class="nav-link dropdown-toggle {{ str_contains(request()->url(), 'donation') ? 'active fw-bold' : 'text-dark' }} px-2 py-1 d-inline-flex align-items-center" 
                               href="#" id="donationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-donate me-1"></i> Donate
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="donationDropdown" style="font-size: 0.9rem;">
                                <li><a class="dropdown-item py-1" href="{{ route('donation.fitraa') }}"><i class="fas fa-hand-holding-heart text-primary me-2"></i>Fitraa</a></li>
                                <li><a class="dropdown-item py-1" href="{{ route('donation.zakat') }}"><i class="fas fa-hand-holding-usd text-success me-2"></i>Zakat</a></li>
                                <li><a class="dropdown-item py-1" href="{{ route('donation.sadqa') }}"><i class="fas fa-heart text-danger me-2"></i>Sadqa</a></li>
                            </ul>
                        </li>
                        <li class="nav-item d-flex align-items-center">
                            <a class="nav-link {{ request()->routeIs('notices.index') ? 'active fw-bold' : 'text-dark' }} px-2 py-1 d-inline-flex align-items-center" 
                               href="{{ route('notices.index') }}">
                                <i class="fas fa-bullhorn me-1"></i> Notices
                            </a>
                        </li>
                        <li class="nav-item d-flex align-items-center">   
                            <a class="nav-link {{ request()->routeIs('question-papers.index') ? 'active fw-bold' : 'text-dark' }} px-2 py-1 d-inline-flex align-items-center" 
                               href="{{ route('question-papers.index') }}">
                                <i class="fas fa-file-alt me-1"></i> Q-Papers
                            </a>
                        </li>
                        <li class="nav-item d-flex align-items-center">
                            <a class="nav-link {{ request()->routeIs('gallery') ? 'active fw-bold' : 'text-dark' }} px-2 py-1 d-inline-flex align-items-center" 
                               href="{{ route('gallery') }}">
                                <i class="fas fa-images me-1"></i> Album
                            </a>
                        </li>
                        <li class="nav-item d-flex align-items-center">
                            <a class="nav-link {{ request()->routeIs('events.index') ? 'active fw-bold' : 'text-dark' }} px-2 py-1 d-inline-flex align-items-center" 
                               href="{{ route('events.index') }}">
                                <i class="fas fa-calendar-alt me-1"></i> Events
                            </a>
                        </li>
                    </ul>
                    <a href="{{ route('user-login') }}" class="btn btn-outline-light ms-3">Login</a>
                </div>
            </div>
        </nav>
    </header>

    <!-- Mobile Header -->
    <header class="main-header d-lg-none">
        <nav class="navbar navbar-dark">
            <div class="container-fluid px-3">
                <div class="d-flex align-items-center w-100">
                    <a class="navbar-brand me-auto" href="/">
                        <div class="d-flex align-items-center">
                            <div style="width: 40px; height: 40px; overflow: hidden; border-radius: 50%;">
                                <img src="{{ asset('img/logo.jpeg') }}" alt="Logo" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                            <div class="ms-2 d-none d-sm-block">
                                <div class="fw-bold" style="font-size: 1rem; line-height: 1.1;">Madarsa Nizamia</div>
                                <div class="small" style="font-size: 0.7rem;">Barkatia</div>
                            </div>
                        </div>
                    </a>
                    
                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mobileNavbar" aria-controls="mobileNavbar" aria-expanded="false" aria-label="Toggle navigation" style="color: var(--primary-color);">
                        <i class="bi bi-list" style="font-size: 1.8rem;"></i>
                    </button>
                </div>
                
                <div class="collapse navbar-collapse bg-white rounded-2 mt-2 p-3 shadow-sm" id="mobileNavbar" style="z-index: 1050;">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                                <i class="bi bi-house-door me-2"></i>Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                                <i class="bi bi-info-circle me-2"></i>About Us
                            </a>
                        </li>
                        <li class="nav-item dropdown dropdown-hover">
                            <a class="nav-link dropdown-toggle {{ str_contains(request()->url(), 'donation') ? 'active fw-bold' : 'text-dark' }} px-2 py-1 d-inline-flex align-items-center" 
                               href="#" id="donationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-donate me-1"></i> Donate
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="donationDropdown" style="font-size: 0.9rem;">
                                <li><a class="dropdown-item py-1" href="{{ route('donation.fitraa') }}"><i class="fas fa-hand-holding-heart text-primary me-2"></i>Fitraa</a></li>
                                <li><a class="dropdown-item py-1" href="{{ route('donation.zakat') }}"><i class="fas fa-hand-holding-usd text-success me-2"></i>Zakat</a></li>
                                <li><a class="dropdown-item py-1" href="{{ route('donation.sadqa') }}"><i class="fas fa-heart text-danger me-2"></i>Sadqa</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('notices.index') ? 'active' : '' }}" href="{{ route('notices.index') }}">
                                <i class="bi bi-bullseye me-2"></i>Notices
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('question-papers.index') ? 'active' : '' }}" href="{{ route('question-papers.index') }}">
                                <i class="bi bi-pencil-square me-2"></i>Question Papers
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}" href="{{ route('gallery') }}">
                                <i class="bi bi-images me-2"></i>Album
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('events.index') ? 'active' : '' }}" href="{{ route('events.index') }}">
                                <i class="bi bi-calendar-event me-2"></i>Events
                            </a>
                        </li>
                        <li class="nav-item mt-3">
                            <a href="{{ route('user-login') }}" class="btn btn-outline-light w-100">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Login
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="main-footer">
        <div class="container">
            <div class="row">
                <!-- Left Column: About Us -->
                @php
                    $aboutSection = \App\Models\FooterContent::getAboutSection();
                @endphp
                <div class="col-md-3 mb-4 mb-lg-0">
                    <h3 class="footer-heading">About Us</h3>
                    @if($aboutSection)
                        <div class="text-light mb-4">
                            {!! $aboutSection->content !!}
                        </div>
                    @else
                        <p class="text-light mb-4">
                            Our mission is to provide quality education and guidance. <br><br> 
                            📖 “Acquire knowledge and impart it to the people.” — Prophet Muhammad ﷺ
                        </p>
                    @endif
                    @php
                        $socialLinks = \App\Models\SocialLink::getActiveLinks();
                    @endphp
                    @if($socialLinks->count() > 0)
                        <div class="social-links">
                            @foreach($socialLinks as $link)
                                <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer" class="me-2" title="{{ $link->platform }}">
                                    @if($link->platform === 'Twitter')
                                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24" aria-label="X" style="width: 16px; height: 16px; vertical-align: middle;">
                                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"></path>
                                        </svg>
                                    @else
                                        <i class="bi {{ $link->icon_class }}"></i>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
                
                <!-- Middle Column: Quick Links -->
                <div class="col-md-3 mb-4 mb-md-0">
                    <h3 class="footer-heading">Quick Links</h3>
                    <ul class="footer-links list-unstyled">
                        <li class="mb-2"><a href="{{ route('home') }}"><i class="bi bi-chevron-right me-2"></i>Home</a></li>
                        <li class="mb-2"><a href="{{ route('about') }}"><i class="bi bi-chevron-right me-2"></i>About Us</a></li>
                        <li class="mb-2"><a href="{{ route('contact') }}"><i class="bi bi-chevron-right me-2"></i>Contact</a></li>
                        <li class="mb-2"><a href="{{ route('privacy') }}"><i class="bi bi-chevron-right me-2"></i>Privacy Policy</a></li>
                    </ul>
                </div>
                
                 <!-- Right Column: Donation -->
                 <div class="col-md-3 mb-4 mb-md-0">
                    <h3 class="footer-heading">Donation</h3>
                    <ul class="footer-links list-unstyled">
                        <li class="mb-2"><a href="{{ route('donation.zakat') }}"><i class="bi bi-chevron-right me-2"></i>Zakaat</a></li>
                        <li class="mb-2"><a href="{{ route('donation.fitraa') }}"><i class="bi bi-chevron-right me-2"></i>Fitraa</a></li>
                        <li class="mb-2"><a href="{{ route('donation.sadqa') }}"><i class="bi bi-chevron-right me-2"></i>Sadqa</a></li>
                    </ul>
                </div>

                <!-- Right Column: Contact Info -->
                @php
                    $contactSection = \App\Models\FooterContent::getContactSection();
                @endphp
                <div class="col-md-3">
                    <h3 class="footer-heading">Contact Info</h3>
                    <ul class="footer-links list-unstyled">
                        @if($contactSection && $contactSection->address)
                            <li class="mb-3">
                                <div class="d-flex">
                                    <span class="me-3 mt-1"><i class="bi bi-geo-alt-fill text-primary"></i></span>
                                    <span>{{ $contactSection->address }}</span>
                                </div>
                            </li>
                        @else
                            <li class="mb-3">
                                <div class="d-flex">
                                    <span class="me-3 mt-1"><i class="bi bi-geo-alt-fill text-primary"></i></span>
                                    <span>masjid, Pargahi Bangar, Kalyanpur, Naramau, Kanpur, Uttar Pradesh 209217</span>
                                </div>
                            </li>
                        @endif

                        @if($contactSection && $contactSection->phone)
                            <li class="mb-3">
                                <div class="d-flex">
                                    <span class="me-3 mt-1"><i class="bi bi-telephone-fill text-primary"></i></span>
                                    <span>{{ $contactSection->phone }}</span>
                                </div>
                            </li>
                        @else
                            <li class="mb-3">
                                <div class="d-flex">
                                    <span class="me-3 mt-1"><i class="bi bi-telephone-fill text-primary"></i></span>
                                    <span>+91 87390 90638</span>
                                </div>
                            </li>
                        @endif

                        @if($contactSection && $contactSection->email)
                            <li class="mb-3">
                                <div class="d-flex">
                                    <span class="me-3 mt-1"><i class="bi bi-envelope-fill text-primary"></i></span>
                                    <span>{{ $contactSection->email }}</span>
                                </div>
                            </li>
                        @else
                            <li class="mb-3">
                                <div class="d-flex">
                                    <span class="me-3 mt-1"><i class="bi bi-envelope-fill text-primary"></i></span>
                                    <span>info@madarsa.com</span>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12 text-center copyright">
                    &copy; {{ date('Y') }} EduInstitute. All rights reserved.
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    
    <script>
        // Go to Top Button
        document.addEventListener('DOMContentLoaded', function() {
            // Show/hide button on scroll
            const goToTopBtn = document.getElementById('goToTopBtn');
            
            window.onscroll = function() {
                if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
                    goToTopBtn.style.display = 'flex';
                    goToTopBtn.style.alignItems = 'center';
                    goToTopBtn.style.justifyContent = 'center';
                } else {
                    goToTopBtn.style.display = 'none';
                }
            };
            
            // Scroll to top when clicked
            goToTopBtn.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            // Add active class to current nav link
            const currentLocation = location.href;
            const menuItems = document.querySelectorAll('.nav-link');
            const menuLength = menuItems.length;
            
            for (let i = 0; i < menuLength; i++) {
                if (menuItems[i].href === currentLocation) {
                    menuItems[i].classList.add('active');
                }
            }
        });
    </script>
    
    @stack('scripts')
    <!-- Go to Top Button -->
    <button id="goToTopBtn" class="btn rounded-circle position-fixed" style="width: 50px; height: 50px; bottom: 30px; right: 30px; display: none; z-index: 99; background-color: #2ecc71; border: none; color: white; box-shadow: 0 2px 10px rgba(0,0,0,0.2); animation: bounce 2s ease infinite;">
        <i class="fas fa-arrow-up"></i>
    </button>
    
    <style>
        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
                animation-timing-function: cubic-bezier(0.8, 0, 1, 1);
            }
            50% {
                transform: translateY(-10px);
                animation-timing-function: cubic-bezier(0, 0, 0.2, 1);
            }
        }
    </style>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom Dropdown Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdowns = document.querySelectorAll('.dropdown-hover');
            let backdrop = document.querySelector('.dropdown-backdrop');
            
            // Create backdrop if it doesn't exist
            if (!backdrop) {
                backdrop = document.createElement('div');
                backdrop.className = 'dropdown-backdrop';
                document.body.appendChild(backdrop);
            }
            
            function closeAllDropdowns() {
                document.querySelectorAll('.dropdown-hover .dropdown-menu').forEach(menu => {
                    menu.classList.remove('show');
                });
                backdrop.classList.remove('show');
                document.body.style.overflow = '';
            }
            
            function openMobileMenu(menu) {
                menu.classList.add('show');
                backdrop.classList.add('show');
                document.body.style.overflow = 'hidden';
            }
            
            dropdowns.forEach(dropdown => {
                const toggle = dropdown.querySelector('.dropdown-toggle');
                const menu = dropdown.querySelector('.dropdown-menu');
                
                // Toggle dropdown on click
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const isMobile = window.innerWidth <= 991.98;
                    const isOpen = menu.classList.contains('show');
                    
                    if (isMobile) {
                        if (!isOpen) {
                            closeAllDropdowns();
                            openMobileMenu(menu);
                        } else {
                            closeAllDropdowns();
                        }
                    } else {
                        // For desktop, use hover behavior
                        const bsDropdown = bootstrap.Dropdown.getOrCreateInstance(toggle);
                        if (!isOpen) {
                            closeAllDropdowns();
                            bsDropdown.show();
                        } else {
                            bsDropdown.hide();
                        }
                    }
                });
                
                // Close when clicking menu items on mobile
                menu.querySelectorAll('.dropdown-item').forEach(item => {
                    item.addEventListener('click', function() {
                        if (window.innerWidth <= 991.98) {
                            closeAllDropdowns();
                        }
                    });
                });
            });
            
            // Close when clicking backdrop
            backdrop.addEventListener('click', closeAllDropdowns);
            
            // Close when clicking outside on mobile
            document.addEventListener('click', function(e) {
                if (window.innerWidth <= 991.98 && !e.target.closest('.dropdown-hover')) {
                    closeAllDropdowns();
                }
            });
            
            // Handle window resize
            window.addEventListener('resize', function() {
                closeAllDropdowns();
            });
            
            // Initialize mobile menu on page load if needed
            if (window.innerWidth <= 991.98) {
                dropdowns.forEach(dropdown => {
                    const menu = dropdown.querySelector('.dropdown-menu');
                    menu.style.display = 'block';
                });
            }
        });
    </script>
    
    <style>
        
    </style>
</body>
</html>