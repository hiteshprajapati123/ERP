@php
    $contact = \App\Models\ContactPage::where('is_active', true)->first();
@endphp

@extends('layouts.app', ['title' => 'Contact Us'])

@section('content')
<!-- Contact Hero Section -->
<section style="background: linear-gradient(rgba(26, 93, 59, 0.9), rgba(26, 93, 59, 0.8)), url('https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center; padding: 100px 0 80px; color: white; text-align: center;">
    <div style="max-width: 800px; margin: 0 auto; padding: 0 20px;">
        <h1 style="font-size: 42px; margin: 0 0 15px; font-weight: 700;">Get In Touch</h1>
        <p style="font-size: 18px; margin: 0; opacity: 0.9;">We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
    </div>
</section>

<!-- Contact Form Section -->
<section style="padding: 80px 0; background: #f8f9fa;">
    <div style="max-width: 1000px; margin: 0 auto; padding: 0 15px;">
        <div style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 5px 30px rgba(0,0,0,0.05);">
            
            <!-- Responsive container -->
            <div class="contact-container @if(!$contact) full-width @endif">
                <!-- Contact Form -->
                <div class="contact-form">
                    <h2 style="font-size: 28px; color: #1A5D3B; margin: 0 0 30px; position: relative; padding-bottom: 15px;">
                        Send Us a Message
                        <span style="position: absolute; bottom: 0; left: 0; width: 50px; height: 3px; background: #D4AF37;"></span>
                    </h2>
                    
                    @if(session('status'))
                        <div class="alert alert-{{ session('status') }} mb-4">
                            {{ session('message') }}
                        </div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST" style="margin-top: 20px;">
                        @csrf
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #2D3748;">Your Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" required class="form-input @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #2D3748;">Email Address</label>
                            <input type="email" name="email" value="{{ old('email') }}" required class="form-input @error('email') border-red-500 @enderror">
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #2D3748;">Subject</label>
                            <input type="text" name="subject" value="{{ old('subject') }}" required class="form-input @error('subject') border-red-500 @enderror">
                            @error('subject')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div style="margin-bottom: 25px;">
                            <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #2D3748;">Your Message</label>
                            <textarea name="message" rows="5" required class="form-textarea @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <button type="submit" class="submit-btn">
                            Send Message
                            <i class="fas fa-paper-plane ms-2"></i>
                        </button>
                    </form>
                </div>
                
                <!-- Contact Info -->
                @if($contact)
                    <div class="contact-info">
                        <h3 style="font-size: 22px; color: #1A5D3B; margin: 0 0 25px; position: relative; padding-bottom: 15px;">
                            Contact Information
                            <span style="position: absolute; bottom: 0; left: 0; width: 40px; height: 2px; background: #D4AF37;"></span>
                        </h3>
                        
                        <div style="margin-bottom: 30px;">
                            <div style="display: flex; margin-bottom: 20px;">
                                <div class="icon-circle"><i class="fas fa-map-marker-alt"></i></div>
                                <div>
                                    <h4 class="info-title">Our Location</h4>
                                    <p class="info-text">{{ $contact->address ?? '123 Islamic Center Road, Naramau, Uttar Pradesh, India' }}</p>
                                </div>
                            </div>
                            
                            <div style="display: flex; margin-bottom: 20px;">
                                <div class="icon-circle"><i class="fas fa-phone-alt"></i></div>
                                <div>
                                    <h4 class="info-title">Phone Number</h4>
                                    <p class="info-text">{{ $contact->phone1 ?? '+91 98765 43210' }}</p>
                                    @if($contact->phone2)
                                        <p class="info-text">{{ $contact->phone2 }}</p>
                                    @endif
                                </div>
                            </div>
                            
                            <div style="display: flex;">
                                <div class="icon-circle"><i class="far fa-envelope"></i></div>
                                <div>
                                    <h4 class="info-title">Email Address</h4>
                                    <p class="info-text">{{ $contact->email1 ?? 'info@madrasanizamia.com' }}</p>
                                    @if($contact->email2)
                                        <p class="info-text">{{ $contact->email2 }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div style="margin-top: 40px;">
                            <h4 class="info-title">Follow Us</h4>
                            @php
                                $socialLinks = \App\Models\SocialLink::getActiveLinks();
                            @endphp
                            <div class="social-links">
                                @if($socialLinks->count() > 0)
                                    @foreach($socialLinks as $link)
                                        <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer" title="{{ $link->platform }}">
                                            @if($link->platform === 'Twitter')
                                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24" aria-label="X" style="width: 16px; height: 16px; vertical-align: middle;">
                                                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"></path>
                                                </svg>
                                            @else
                                                <i class="bi {{ $link->icon_class }}"></i>
                                            @endif
                                        </a>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Styles -->
<style>
    /* Layout structure */
    .contact-container {
        display: flex;
        flex-wrap: wrap;
    }

    .contact-form {
        flex: 0 0 60%;
        max-width: 60%;
        padding: 40px;
    }

    .contact-info {
        flex: 0 0 40%;
        max-width: 40%;
        background: #f7fafc;
        padding: 40px;
        position: relative;
    }

    /* Full width form when no contact info */
    .contact-container.full-width .contact-form {
        flex: 0 0 100%;
        max-width: 100%;
    }

    /* Form fields */
    .form-input, .form-textarea {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 15px;
        transition: all 0.3s ease;
    }
    .form-input:focus, .form-textarea:focus {
        border-color: #1A5D3B;
        box-shadow: 0 0 0 3px rgba(26, 93, 59, 0.1);
        outline: none;
    }

    /* Button */
    .submit-btn {
        background: #1A5D3B;
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
    }
    .submit-btn:hover {
        background: #14422c;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(26, 93, 59, 0.3);
    }
    .submit-btn:hover i {
        transform: translateX(5px);
    }

    /* Info section icons */
    .icon-circle {
        width: 40px;
        height: 40px;
        background: rgba(26, 93, 59, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        flex-shrink: 0;
        color: #1A5D3B;
    }
    .info-title {
        font-size: 16px;
        color: #2D3748;
        margin: 0 0 5px 0;
    }
    .info-text {
        margin: 0;
        color: #6c757d;
        font-size: 14px;
        line-height: 1.6;
    }

    /* Social links - scoped to contact form */
    .contact-info .social-links a {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: #e2e8f0;
        color: #1A5D3B;
        text-decoration: none;
        transition: all 0.3s ease;
        margin-right: 10px;
    }
    .contact-info .social-links a:hover {
        background: #1A5D3B;
        color: white;
    }

    /* Responsive styles */
    @media (max-width: 992px) {
        .contact-form, .contact-info {
            flex: 0 0 100%;
            max-width: 100%;
            padding: 30px;
        }
        .contact-container {
            flex-direction: column;
        }
    }

    @media (max-width: 576px) {
        section h1 {
            font-size: 32px !important;
        }
        .contact-form, .contact-info {
            padding: 25px 20px !important;
        }
        .submit-btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endsection
