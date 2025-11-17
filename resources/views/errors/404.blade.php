@extends('layouts.app')

@section('title', 'Page Not Found - 404')

@section('content')
<style>
.error-404-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #f0f4f8 100%);
    padding: 120px 0 80px;
    position: relative;
    overflow: hidden;
    min-height: 80vh;
    display: flex;
    align-items: center;
}

.error-404-section::before {
    content: '';
    position: absolute;
    top: -50px;
    right: -50px;
    width: 300px;
    height: 300px;
    background: rgba(46, 204, 113, 0.05);
    border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
    animation: float 6s ease-in-out infinite;
}

.error-404-section::after {
    content: '';
    position: absolute;
    bottom: -100px;
    left: -50px;
    width: 400px;
    height: 400px;
    background: rgba(52, 152, 219, 0.03);
    border-radius: 50%;
    animation: float 8s ease-in-out infinite reverse;
}

.error-404-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    position: relative;
    z-index: 2;
}

.error-404-content {
    text-align: center;
    max-width: 800px;
    margin: 0 auto;
}

.error-404-number {
    font-size: 12rem;
    font-weight: 800;
    color: var(--primary-color);
    line-height: 1;
    margin-bottom: 20px;
    position: relative;
    text-shadow: 0 10px 30px rgba(46, 204, 113, 0.2);
    animation: pulse 2s ease-in-out infinite;
}

.error-404-number::before {
    content: '404';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    opacity: 0.3;
    z-index: -1;
    animation: float 4s ease-in-out infinite;
}

.error-404-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 20px;
    position: relative;
    display: inline-block;
}

.error-404-title::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
    border-radius: 2px;
}

.error-404-description {
    font-size: 1.2rem;
    color: #5a7184;
    margin-bottom: 40px;
    line-height: 1.7;
}

.error-reasons {
    background: white;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    padding: 40px;
    margin-bottom: 40px;
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.error-reasons-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    margin-top: 30px;
}

.error-reason-item {
    display: flex;
    align-items: center;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 12px;
    transition: all 0.3s ease;
    border: 1px solid transparent;
}

.error-reason-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    border-color: var(--primary-color);
}

.error-reason-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 20px;
    font-size: 1.3rem;
    flex-shrink: 0;
}

.error-reason-icon.warning {
    background: rgba(241, 196, 15, 0.1);
    color: #f39c12;
}

.error-reason-icon.info {
    background: rgba(52, 152, 219, 0.1);
    color: var(--secondary-color);
}

.error-reason-icon.danger {
    background: rgba(231, 76, 60, 0.1);
    color: #e74c3c;
}

.error-reason-icon.secondary {
    background: rgba(149, 165, 166, 0.1);
    color: #95a5a6;
}

.error-reason-text {
    font-size: 0.95rem;
    color: #2c3e50;
    font-weight: 500;
}

.error-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
    margin-bottom: 40px;
}

.btn-home {
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    color: white;
    padding: 15px 35px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    border: 2px solid var(--primary-color);
    display: inline-flex;
    align-items: center;
    box-shadow: 0 5px 15px rgba(46, 204, 113, 0.2);
}

.btn-home:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(46, 204, 113, 0.3);
    background: linear-gradient(135deg, var(--primary-dark), var(--primary-color));
    color: white;
}

.btn-back {
    background: white;
    color: var(--primary-color);
    padding: 15px 35px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    border: 2px solid var(--primary-color);
    display: inline-flex;
    align-items: center;
    cursor: pointer;
}

.btn-back:hover {
    background: var(--primary-color);
    color: white;
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(46, 204, 113, 0.2);
}

.error-footer {
    text-align: center;
    color: #7f8c8d;
    font-size: 0.9rem;
}

.error-footer a {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}

.error-footer a:hover {
    color: var(--primary-dark);
    text-decoration: underline;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-20px);
    }
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .error-404-section {
        padding: 80px 0 60px;
    }
    
    .error-404-number {
        font-size: 6rem;
    }
    
    .error-404-title {
        font-size: 1.8rem;
    }
    
    .error-404-description {
        font-size: 1rem;
    }
    
    .error-reasons {
        padding: 25px;
    }
    
    .error-reasons-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .error-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .btn-home,
    .btn-back {
        width: 100%;
        max-width: 300px;
        justify-content: center;
    }
}
</style>

<section class="error-404-section">
    <div class="error-404-container">
        <div class="error-404-content">
            <div class="error-404-number">404</div>
            <h1 class="error-404-title">Page Not Found</h1>
            <p class="error-404-description">
                Oops! The page you're looking for seems to have vanished into the digital void. 
                Don't worry, even the best explorers sometimes lose their way.
            </p>
            
            <div class="error-reasons">
                <h3 style="color: #2c3e50; margin-bottom: 10px; font-size: 1.3rem;">What might have happened?</h3>
                <div class="error-reasons-grid">
                    <div class="error-reason-item">
                        <div class="error-reason-icon warning">
                            <i class="bi bi-exclamation-triangle"></i>
                        </div>
                        <div class="error-reason-text">You might have mistyped the URL</div>
                    </div>
                    <div class="error-reason-item">
                        <div class="error-reason-icon info">
                            <i class="bi bi-link-45deg"></i>
                        </div>
                        <div class="error-reason-text">The page has been moved to a new location</div>
                    </div>
                    <div class="error-reason-item">
                        <div class="error-reason-icon danger">
                            <i class="bi bi-trash"></i>
                        </div>
                        <div class="error-reason-text">The page has been permanently removed</div>
                    </div>
                    <div class="error-reason-item">
                        <div class="error-reason-icon secondary">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <div class="error-reason-text">You don't have permission to access this page</div>
                    </div>
                </div>
            </div>
            
            <div class="error-actions">
                <a href="{{ route('home') }}" class="btn-home">
                    <i class="bi bi-house-door me-2"></i>
                    Go to Homepage
                </a>
                <button onclick="history.back()" class="btn-back">
                    <i class="bi bi-arrow-left me-2"></i>
                    Go Back
                </button>
            </div>
            
            <div class="error-footer">
                <p>If you believe this is an error, please <a href="{{ route('contact') }}">contact our support team</a></p>
                <p style="margin-top: 10px; font-size: 0.8rem;">Error Code: 404 | Page Not Found</p>
            </div>
        </div>
    </div>
</section>
@endsection
