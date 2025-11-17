<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Under Maintenance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
<style>
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

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', sans-serif;
    line-height: 1.6;
    color: var(--dark-color);
    background: var(--light-color);
}

.maintenance-section {
    background: linear-gradient(135deg, var(--light-color) 0%, var(--header-bg) 100%);
    padding: 120px 0 80px;
    position: relative;
    overflow: hidden;
    min-height: 100vh;
    display: flex;
    align-items: center;
}

.maintenance-section::before {
    content: '';
    position: absolute;
    top: -50px;
    right: -50px;
    width: 300px;
    height: 300px;
    background: rgba(52, 152, 219, 0.05);
    border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
    animation: float 6s ease-in-out infinite;
}

.maintenance-section::after {
    content: '';
    position: absolute;
    bottom: -100px;
    left: -50px;
    width: 400px;
    height: 400px;
    background: rgba(46, 204, 113, 0.03);
    border-radius: 50%;
    animation: float 8s ease-in-out infinite reverse;
}

.maintenance-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    position: relative;
    z-index: 2;
}

.maintenance-content {
    text-align: center;
    max-width: 800px;
    margin: 0 auto;
}

.maintenance-icon {
    font-size: 6rem;
    color: var(--secondary-color);
    margin-bottom: 30px;
    animation: pulse 2s ease-in-out infinite;
}

.maintenance-title {
    font-size: 3rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 20px;
    position: relative;
    display: inline-block;
}

.maintenance-title::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, var(--secondary-color), var(--primary-color));
    border-radius: 2px;
}

.maintenance-message {
    font-size: 1.3rem;
    color: #5a7184;
    margin-bottom: 40px;
    line-height: 1.7;
}

.maintenance-details {
    background: white;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    padding: 40px;
    margin-bottom: 40px;
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.maintenance-info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    margin-bottom: 30px;
}

.maintenance-info-item {
    text-align: center;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 12px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.maintenance-info-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.maintenance-info-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    font-size: 1.5rem;
    color: white;
}

.maintenance-info-label {
    font-size: 0.9rem;
    color: #7f8c8d;
    margin-bottom: 5px;
    text-transform: uppercase;
    font-weight: 600;
}

.maintenance-info-value {
    font-size: 1.1rem;
    color: #2c3e50;
    font-weight: 500;
}

.progress-bar {
    background: #e9ecef;
    border-radius: 50px;
    height: 8px;
    overflow: hidden;
    margin: 20px 0;
}

.progress-fill {
    background: linear-gradient(90deg, var(--secondary-color), var(--primary-color));
    height: 100%;
    border-radius: 50px;
    animation: progress 2s ease-in-out infinite;
}

.countdown-timer {
    font-size: 2rem;
    font-weight: 700;
    color: var(--secondary-color);
    margin: 20px 0;
    font-family: 'Courier New', monospace;
}

.contact-section {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: white;
    padding: 30px;
    border-radius: 12px;
    margin-top: 30px;
}

.contact-section h3 {
    color: white;
    margin-bottom: 20px;
    font-size: 1.3rem;
}

.contact-info {
    display: flex;
    justify-content: center;
    gap: 40px;
    flex-wrap: wrap;
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 10px;
}

.contact-item i {
    font-size: 1.2rem;
}

.maintenance-footer {
    text-align: center;
    color: #7f8c8d;
    font-size: 0.9rem;
    margin-top: 40px;
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
        transform: scale(1.1);
    }
}

@keyframes progress {
    0% {
        width: 0%;
    }
    50% {
        width: 70%;
    }
    100% {
        width: 100%;
    }
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .maintenance-section {
        padding: 80px 0 60px;
    }
    
    .maintenance-icon {
        font-size: 4rem;
    }
    
    .maintenance-title {
        font-size: 2rem;
    }
    
    .maintenance-message {
        font-size: 1.1rem;
    }
    
    .maintenance-details {
        padding: 25px;
    }
    
    .maintenance-info-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .contact-info {
        flex-direction: column;
        gap: 15px;
    }
    
    .countdown-timer {
        font-size: 1.5rem;
    }
}
</style>

<section class="maintenance-section">
    <div class="maintenance-container">
        <div class="maintenance-content">
            <div class="maintenance-icon">
                <i class="bi bi-tools"></i>
            </div>
            
            <h1 class="maintenance-title">
                {{ $maintenance->title ?? 'Under Maintenance' }}
            </h1>
            
            <p class="maintenance-message">
                {{ $maintenance->message ?? 'We are currently performing scheduled maintenance. We\'ll be back shortly!' }}
            </p>
            
            <div class="maintenance-details">
                <div class="maintenance-info-grid">
                    <div class="maintenance-info-item">
                        <div class="maintenance-info-icon">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <div class="maintenance-info-label">Status</div>
                        <div class="maintenance-info-value">In Progress</div>
                    </div>
                    
                    @if($maintenance->estimated_time)
                    <div class="maintenance-info-item">
                        <div class="maintenance-info-icon">
                            <i class="bi bi-hourglass-split"></i>
                        </div>
                        <div class="maintenance-info-label">Estimated Time</div>
                        <div class="maintenance-info-value">{{ $maintenance->estimated_time }}</div>
                    </div>
                    @endif
                    
                    @if($maintenance->starts_at)
                    <div class="maintenance-info-item">
                        <div class="maintenance-info-icon">
                            <i class="bi bi-calendar-event"></i>
                        </div>
                        <div class="maintenance-info-label">Started</div>
                        <div class="maintenance-info-value">{{ $maintenance->starts_at->format('M d, Y H:i') }}</div>
                    </div>
                    @endif
                    
                    @if($maintenance->ends_at)
                    <div class="maintenance-info-item">
                        <div class="maintenance-info-icon">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                        <div class="maintenance-info-label">Expected Back</div>
                        <div class="maintenance-info-value">{{ $maintenance->ends_at->format('M d, Y H:i') }}</div>
                    </div>
                    @endif
                </div>
                
                @if($maintenance->ends_at)
                <div class="progress-bar">
                    <div class="progress-fill"></div>
                </div>
                <div class="countdown-timer" id="countdown">
                    Calculating...
                </div>
                @endif
            </div>
            
            @if($maintenance->contact_email || $maintenance->contact_phone)
            <div class="contact-section">
                <h3>Need Assistance?</h3>
                <div class="contact-info">
                    @if($maintenance->contact_email)
                    <div class="contact-item">
                        <i class="bi bi-envelope-fill"></i>
                        <span>{{ $maintenance->contact_email }}</span>
                    </div>
                    @endif
                    
                    @if($maintenance->contact_phone)
                    <div class="contact-item">
                        <i class="bi bi-telephone-fill"></i>
                        <span>{{ $maintenance->contact_phone }}</span>
                    </div>
                    @endif
                </div>
            </div>
            @endif
            
            <div class="maintenance-footer">
                <p>We apologize for any inconvenience. Thank you for your patience!</p>
                <p style="margin-top: 10px; font-size: 0.8rem;">
                    Maintenance ID: {{ uniqid('mnt_') }} | 
                    Current Time: {{ now()->format('H:i:s') }}
                </p>
            </div>
        </div>
    </div>
</section>

@if($maintenance->ends_at)
<script>
document.addEventListener('DOMContentLoaded', function() {
    const endTime = new Date('{{ $maintenance->ends_at->toISOString() }}').getTime();
    const countdownElement = document.getElementById('countdown');
    
    function updateCountdown() {
        const now = new Date().getTime();
        const distance = endTime - now;
        
        if (distance < 0) {
            countdownElement.innerHTML = 'Maintenance Complete!';
            return;
        }
        
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
        let timeString = '';
        if (days > 0) timeString += days + 'd ';
        if (hours > 0) timeString += hours + 'h ';
        if (minutes > 0) timeString += minutes + 'm ';
        timeString += seconds + 's';
        
        countdownElement.innerHTML = timeString;
    }
    
    updateCountdown();
    setInterval(updateCountdown, 1000);
});
</script>
@endif
</body>
</html>
