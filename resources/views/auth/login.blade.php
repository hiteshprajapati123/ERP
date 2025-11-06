<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Login - Madrasa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" href="{{ asset('img/logo.jpeg') }}" type="image/jpeg">
    <style>
        :root {
            --primary-color: #1a5f7a;    /* Deep teal blue */
            --secondary-color: #57c4e5;  /* Light blue */
            --accent-color: #ff9f29;    /* Golden yellow */
            --dark-color: #2c3e50;      /* Dark blue-gray */
            --light-color: #f8f9fc;     /* Off-white */
            --border-color: #e0e6ed;    /* Light gray */
            --text-primary: #2d3436;    /* Dark gray for text */
            --text-secondary: #636e72;  /* Medium gray for secondary text */
            --success-color: #2ecc71;   /* Green for success messages */
            --danger-color: #e74c3c;    /* Red for errors */
            --shadow-sm: 0 2px 8px rgba(0,0,0,0.08);
            --shadow-md: 0 4px 12px rgba(0,0,0,0.1);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', sans-serif;
            color: var(--text-primary);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 1rem;
        }
        
        .login-container {
            max-width: 420px;
            width: 100%;
            margin: 2rem auto;
            background: rgba(255, 255, 255, 0.98);
            border-radius: 16px;
            box-shadow: var(--shadow-md);
            overflow: hidden;
            position: relative;
            z-index: 1;
            transition: var(--transition);
        }
        
        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        }
        
        .login-content {
            padding: 2.5rem;
        }
        
        .login-logo {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .login-logo img {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 1rem;
            border: 4px solid white;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
        }
        
        .login-logo img:hover {
            transform: scale(1.05);
        }
        
        .login-title {
            color: var(--primary-color);
            font-weight: 700;
            font-size: 1.75rem;
            margin-bottom: 0.5rem;
            text-align: center;
        }
        
        .login-subtitle {
            color: var(--text-secondary);
            text-align: center;
            margin-bottom: 2rem;
            font-size: 1rem;
        }
        
        .form-label {
            font-weight: 500;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }
        
        .form-control {
            height: 48px;
            border: 2px solid var(--border-color);
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: var(--transition);
            background-color: #fff;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(26, 95, 122, 0.15);
        }
        
        .input-group-text {
            background-color: #f8f9fa;
            border: 2px solid var(--border-color);
            border-right: none;
            color: var(--text-secondary);
            transition: var(--transition);
        }
        
        .input-group .form-control {
            border-left: none;
            padding-left: 0.5rem;
        }
        
        .input-group:focus-within .input-group-text {
            border-color: var(--primary-color);
            background-color: #f1f9ff;
        }
        
        .btn-login {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            height: 48px;
            font-weight: 600;
            border-radius: 10px;
            font-size: 1rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            transition: var(--transition);
            box-shadow: 0 4px 15px rgba(26, 95, 122, 0.2);
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(26, 95, 122, 0.3);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        .form-check-input {
            width: 1.1em;
            height: 1.1em;
            margin-top: 0.15em;
            border: 2px solid var(--border-color);
        }
        
        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .form-check-label {
            color: var(--text-secondary);
            font-size: 0.9rem;
            user-select: none;
        }
        
        .forgot-password {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: var(--transition);
        }
        
        .forgot-password:hover {
            color: var(--secondary-color);
            text-decoration: none;
        }
        
        .alert {
            border: none;
            border-radius: 10px;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
        }
        
        .alert-danger {
            background-color: #fde8e8;
            color: var(--danger-color);
        }
        
        .btn-close {
            background-size: 0.7rem;
            opacity: 0.7;
        }
        
        .btn-close:hover {
            opacity: 1;
        }
        
        /* Responsive Design */
        @media (max-width: 576px) {
            body {
                padding: 0.5rem;
                background: #f5f7fa;
            }
            
            .login-container {
                margin: 0.5rem auto;
                border-radius: 12px;
            }
            
            .login-content {
                padding: 1.75rem 1.5rem;
            }
            
            .login-logo img {
                width: 80px;
                height: 80px;
            }
            
            .login-title {
                font-size: 1.5rem;
            }
            
            .form-control, .btn-login {
                height: 46px;
            }
        }
        
        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .login-container {
            animation: fadeIn 0.5s ease-out;
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-content">
            <div class="login-logo">
                <img src="{{ asset('img/logo.jpeg') }}" alt="Madrasa Logo">
                <h1 class="login-title">Welcome Back</h1>
                <p class="login-subtitle">Sign in to access your dashboard</p>

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('user-login') }}">
            @csrf
            
            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1 text-muted">
                    <label for="login" class="form-label">Email or Phone Number</label>
                </div>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user text-muted"></i></span>
                    <input type="text" 
                            class="form-control @error('login') is-invalid @enderror" 
                            id="login" 
                            name="login" 
                            value="{{ old('login') }}" 
                            placeholder="Enter your email or phone number"
                            required 
                            autocomplete="email" 
                            autofocus>
                </div>
                @error('login')
                    <div class="invalid-feedback d-block">
                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center mb-1 text-muted">
                    <label for="password" class="form-label">Password</label>
                </div>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock text-muted"></i></span>
                    <input type="password" 
                            class="form-control @error('password') is-invalid @enderror" 
                            id="password" 
                            name="password" 
                            placeholder="Enter your password"
                            required 
                            autocomplete="current-password">
                </div>
                @error('password')
                    <div class="invalid-feedback d-block">
                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        Remember me
                    </label>
                </div>
            </div>

                <button type="submit" class="btn btn-primary btn-login w-100 mb-3">
                    <i class="fas fa-sign-in-alt me-2"></i> Sign In
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add smooth scrolling to all links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Add animation to form elements on load
        document.addEventListener('DOMContentLoaded', () => {
            const inputs = document.querySelectorAll('.form-control');
            inputs.forEach((input, index) => {
                input.style.animation = `fadeIn 0.5s ease-out ${index * 0.1}s forwards`;
                input.style.opacity = '0';
            });
        });
    </script>
</body>
</html>