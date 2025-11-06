<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'User Dashboard') - {{ config('app.name') }}</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/logo.jpeg') }}" type="image/jpeg">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* Base Theme Variables */
        :root {
            /* Light Theme Colors */
            --primary-color: #4f46e5;     /* Indigo 600 */
            --primary-dark: #4338ca;      /* Indigo 700 */
            --primary-light: #e0e7ff;     /* Indigo 100 */
            --secondary-color: #7c3aed;   /* Violet 600 */
            --accent-color: #f59e0b;      /* Amber 500 */
            --accent-hover: #d97706;      /* Amber 600 */
            
            /* Light Theme UI Colors */
            --bg-light: #f9fafb;          /* Gray 50 */
            --bg-card: #ffffff;           /* White */
            --text-primary: #111827;      /* Gray 900 */
            --text-secondary: #4b5563;    /* Gray 600 */
            --border-color: #e5e7eb;      /* Gray 200 */
            
            /* Sidebar */
            --sidebar-bg: #1f2937;        /* Gray 800 */
            --sidebar-hover: #374151;     /* Gray 700 */
            --sidebar-text: #f9fafb;      /* Gray 50 */
            
            /* Status Colors */
            --success: #10b981;           /* Emerald 500 */
            --warning: #f59e0b;           /* Amber 500 */
            --danger: #ef4444;            /* Red 500 */
            --info: #6b7280;              /* Gray 500 */
            
            /* Transitions */
            --transition-speed: 0.3s;
            
            /* Layout */
            --sidebar-width: 280px;
            --header-height: 60px;
        }

        /* Dark Theme Overrides */
        [data-theme="dark"] {
            --bg-light: #111827;          /* Gray 900 */
            --bg-card: #1f2937;           /* Gray 800 */
            --text-primary: #f9fafb;      /* Gray 50 */
            --text-secondary: #9ca3af;    /* Gray 400 */
            --border-color: #374151;      /* Gray 700 */
            
            --sidebar-bg: #111827;        /* Gray 900 */
            --sidebar-hover: #1f2937;     /* Gray 800 */
        }

        /* Base Styles */
        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-light);
            color: var(--text-primary);
            transition: background-color var(--transition-speed), 
                       color var(--transition-speed);
            line-height: 1.6;
        }

        /* Typography */
        h1, h2, h3, h4, h5, h6 {
            color: var(--text-primary);
            font-weight: 600;
            margin-bottom: 1rem;
        }

        p {
            color: var(--text-secondary);
            margin-bottom: 1rem;
        }

        a {
            color: var(--primary-color);
            text-decoration: none;
            transition: color var(--transition-speed);
        }

        a:hover {
            color: var(--primary-dark);
        }

        /* Layout Components */
        .main-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            min-height: 100vh;
            background: #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
            z-index: 1000;
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            color: var(--sidebar-text);
            transition: all var(--transition-speed) ease;
            position: fixed;
            height: 100vh;
            flex-direction: column;
            overflow: hidden;
        }

        .sidebar li {
            margin: 5px 0;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .sidebar li a {
            color: #4a5568;
            padding: 10px 15px;
            display: block;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .sidebar li:hover {
            background-color: #f7fafc;
        }

        .sidebar li.active {
            background-color: #1a5f7a;
        }

        .sidebar li.active a {
            color: white;
        }

        .sidebar li.active i {
            color: white;
        }

        .sidebar li a i {
            width: 20px;
            margin-right: 10px;
            text-align: center;
            color: #718096;
        }

        .sidebar li:hover a,
        .sidebar li:hover i {
            color: #1a5f7a;
        }

        .sidebar li.active:hover a,
        .sidebar li.active:hover i {
            color: white;
        }

        .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-menu {
            padding: 20px 0;
            list-style: none;
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            padding-right: 5px;
            margin-right: 5px;
        }

        /* Custom Scrollbar for Webkit Browsers */
        .sidebar-menu::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar-menu::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
        }

        .sidebar-menu::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
        }

        .sidebar-menu::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        /* Custom Scrollbar for Firefox */
        .sidebar-menu {
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, 0.2) rgba(255, 255, 255, 0.1);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 20px;
            transition: all var(--transition-speed) ease;
        }

        /* Top Navigation */
        .top-navbar {
            background: var(--bg-card);
            border-radius: 10px;
            padding: 15px 25px;
            margin-bottom: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-color);
        }

        /* Cards */
        .card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            transition: all var(--transition-speed) ease;
            margin-bottom: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background: transparent;
            border-bottom: 1px solid var(--border-color);
            padding: 15px 20px;
            font-weight: 600;
        }

        .card-body {
            padding: 20px;
        }

        /* Buttons */
        .btn {
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 500;
            transition: all var(--transition-speed) ease;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        /* Forms */
        .form-control {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            padding: 10px 15px;
            border-radius: 6px;
            transition: all var(--transition-speed) ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(79, 70, 229, 0.25);
        }

        /* Theme Toggle */
        .theme-toggle-container {
            display: flex;
            align-items: center;
            margin: 0 10px;
        }

        .theme-toggle {
            --size: 1.5rem;
            --icon-size: 0.8em;
            --padding: 0.2em;
            --track-width: calc(var(--size) * 1.8);
            --track-height: calc(var(--size) * 1);
            --thumb-size: calc(var(--track-height) - (var(--padding) * 2));
            
            position: relative;
            width: var(--track-width);
            height: var(--track-height);
            padding: var(--padding);
            background: var(--bg-card);
            border: 2px solid var(--border-color);
            border-radius: 100px;
            cursor: pointer;
            transition: all 0.3s ease;
            overflow: visible;
        }

        .theme-toggle:hover {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px var(--primary-light);
        }

        .theme-toggle:focus {
            outline: none;
            box-shadow: 0 0 0 3px var(--primary-light);
        }

        .theme-toggle-track {
            position: relative;
            width: 100%;
            height: 100%;
            display: block;
        }

        .theme-toggle-handle {
            position: absolute;
            top: 50%;
            left: var(--padding);
            width: var(--thumb-size);
            height: var(--thumb-size);
            background: var(--primary-color);
            border-radius: 50%;
            transform: translateY(-50%);
            transition: all 0.3s cubic-bezier(0.4, 0.03, 0.17, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2;
        }

        .theme-toggle-icon {
            position: absolute;
            color: white;
            font-size: var(--icon-size);
            transition: all 0.3s ease;
            opacity: 0.8;
        }

        .theme-toggle-sun {
            left: 0.3em;
            opacity: 0;
            transform: scale(0.5);
        }

        .theme-toggle-moon {
            right: 0.3em;
            opacity: 0.5;
            transform: scale(0.5);
        }

        [data-theme="dark"] .theme-toggle-handle {
            left: calc(100% - var(--thumb-size) - var(--padding));
            background: var(--primary-color);
        }

        [data-theme="dark"] .theme-toggle-sun {
            opacity: 0.5;
            transform: scale(1);
        }

        [data-theme="dark"] .theme-toggle-moon {
            opacity: 0;
            transform: scale(0.5);
        }

        /* Icons */
        .nav-icon {
            font-size: 1.25rem;
            color: var(--text-primary);
            transition: color 0.2s ease;
            vertical-align: middle;
        }

        /* Notification Badge */
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            font-size: 0.65rem;
            padding: 0.2em 0.4em;
            background-color: var(--danger);
            border-radius: 10px;
            color: white;
            font-weight: bold;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
                width: 100%;
            }
            
            #sidebarToggle {
                display: block !important;
            }
        }

        /* Utility Classes */
        .text-muted {
            color: var(--text-secondary) !important;
        }

        .bg-light {
            background-color: var(--bg-light) !important;
        }

        .bg-white {
            background-color: var(--bg-card) !important;
        }

        .border {
            border-color: var(--border-color) !important;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <img src="{{ asset('img/logo.jpeg') }}" alt="Logo" style="height: 40px; width: auto;">
                <h4 class="mt-2 mb-0 text-white">User Dashboard</h4>
            </div>
            
            <ul class="sidebar-menu">
                <li class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('user.dashboard') }}">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>
                <li class="{{ request()->routeIs('user.profile') ? 'active' : '' }}">
                    <a href="{{ route('user.profile') }}">
                        <i class="fas fa-user-circle"></i> Profile
                    </a>
                </li>
                <li class="{{ request()->is('*attendance*') ? 'active' : '' }}">
                    <a href="{{ route('user.attendance.index') }}">
                        <i class="fas fa-calendar-check"></i> Attendance
                    </a>
                </li>
                <li class="{{ request()->is('*fees*') ? 'active' : '' }}">
                    <a href="{{ route('user.fees') }}">
                        <i class="fas fa-money-bill-wave"></i> Pending Fees
                    </a>
                </li>
                <li class="{{ request()->is('*exam-results*') ? 'active' : '' }}">
                    <a href="{{ route('user.exam.results.index') }}">
                        <i class="fas fa-clipboard-check me-2"></i> Exam Results
                    </a>
                </li>
                <li class="{{ request()->is('*notices*') ? 'active' : '' }}">
                    <a href="{{ route('user.notices.index') }}">
                        <i class="fas fa-bullhorn"></i> Notices
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content" id="main-content">
            <!-- Top Navigation -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow-sm mb-4">
                <div class="container-fluid">
                    <button class="btn btn-link d-md-none" id="sidebarToggle">
                        <i class="fas fa-bars nav-icon"></i>
                    </button>
                    
                    <div class="d-flex align-items-center ms-auto gap-3">
                        <!-- Theme Toggle Button Removed -->
                        
                        <!-- Notifications Dropdown -->
                        <div class="dropdown">
                            <a href="#" class="nav-link position-relative" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-bell nav-icon"></i>
                                <span class="notification-badge">3</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-end">
                                <li><h6 class="dropdown-header">Notifications</h6></li>
                                <li><a class="dropdown-item" href="#">New message from John</a></li>
                                <li><a class="dropdown-item" href="#">Assignment due tomorrow</a></li>
                                <li><a class="dropdown-item" href="#">New course available</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-primary" href="#">View all notifications</a></li>
                            </ul>
                        </div>
                        
                        <!-- User Dropdown -->
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" 
                               role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=1a5f7a&color=fff" 
                                     alt="User" class="rounded-circle me-2" width="32">
                                <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="{{ route('user.profile') }}"><i class="fas fa-user me-2"></i> Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <div class="container-fluid">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
            
            // Toggle sidebar on mobile
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const sidebarToggle = document.getElementById('sidebarToggle');
            
            // Toggle sidebar function
            function toggleSidebar() {
                sidebar.classList.toggle('active');
                mainContent.classList.toggle('active');
                
                // Save sidebar state in localStorage
                const isOpen = sidebar.classList.contains('active');
                localStorage.setItem('sidebarOpen', isOpen);
            }
            
            // Close sidebar when clicking outside on mobile
            function handleOutsideClick(event) {
                if (window.innerWidth <= 992 && 
                    !sidebar.contains(event.target) && 
                    !sidebarToggle.contains(event.target) &&
                    sidebar.classList.contains('active')) {
                    toggleSidebar();
                }
            }
            
            // Initialize theme if toggle exists
            function initTheme() {
                const savedTheme = localStorage.getItem('theme') || 'light';
                const html = document.documentElement;
                const themeToggle = document.getElementById('themeToggle');
                
                // Set theme
                html.setAttribute('data-theme', savedTheme);
                
                // Only proceed if theme toggle exists
                if (themeToggle) {
                    // Set button state
                    if (savedTheme === 'dark') {
                        themeToggle.classList.add('dark');
                    } else {
                        themeToggle.classList.remove('dark');
                    }
                    
                    // Add click event for theme toggle
                    themeToggle.addEventListener('click', function() {
                        const currentTheme = html.getAttribute('data-theme');
                        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                        
                        // Update theme attribute
                        html.setAttribute('data-theme', newTheme);
                        localStorage.setItem('theme', newTheme);
                        
                        // Update button state
                        if (newTheme === 'dark') {
                            themeToggle.classList.add('dark');
                        } else {
                            themeToggle.classList.remove('dark');
                        }
                    });
                }
            }
            
            // Initialize sidebar state
            function initSidebar() {
                const isOpen = localStorage.getItem('sidebarOpen') === 'true';
                
                if (isOpen && window.innerWidth <= 992) {
                    sidebar.classList.add('active');
                    mainContent.classList.add('active');
                }
                
                // Add event listeners
                sidebarToggle.addEventListener('click', toggleSidebar);
                document.addEventListener('click', handleOutsideClick);
                
                // Close sidebar when a menu item is clicked on mobile
                const menuItems = document.querySelectorAll('.sidebar-menu a');
                menuItems.forEach(item => {
                    item.addEventListener('click', () => {
                        if (window.innerWidth <= 992) {
                            toggleSidebar();
                        }
                    });
                });
            }
            
            // Handle window resize
            function handleResize() {
                if (window.innerWidth > 992) {
                    sidebar.classList.remove('active');
                    mainContent.classList.remove('active');
                }
            }
            
            // Initialize everything
            initTheme();
            initSidebar();
            window.addEventListener('resize', handleResize);
        });
    </script>
    
    @stack('scripts')
    
    <!-- Go to Top Button -->
    <button id="goToTopBtn" class="btn rounded-circle position-fixed" style="width: 50px; height: 50px; bottom: 30px; right: 30px; display: none; z-index: 99; background-color: #4f46e5; border: none; color: white; box-shadow: 0 2px 10px rgba(0,0,0,0.2); animation: bounce 2s ease infinite;">
        <i class="fas fa-arrow-up"></i>
    </button>
    
    <!-- CSRF Token for AJAX -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
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
        
        #goToTopBtn:hover {
            background-color: #4338ca !important;
        }
    </style>
    
    <script>
        // Initialize CSRF token for AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

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
    </script>
</body>
</html>