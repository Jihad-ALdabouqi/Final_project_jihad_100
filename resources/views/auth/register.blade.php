@extends('user.layouts.master')

@section('title', 'Register')

@section('content')
<div class="login-wrapper" style="background: url('{{ asset('img/hero-slider-1.jpg') }}') center center no-repeat; 
                                   background-size: cover; 
                                   min-height: 100vh; 
                                   display: flex; 
                                   align-items: center; 
                                   justify-content: center;
                                   position: relative;
                                   padding: 60px 0;">
    
    <!-- Blur Overlay -->
    <div style="position: absolute; 
                top: 0; 
                left: 0; 
                width: 100%; 
                height: 100%; 
                background: rgba(0, 0, 0, 0.6);
                backdrop-filter: blur(8px);
                -webkit-backdrop-filter: blur(8px);
                z-index: 1;">
    </div>

    <div class="container" style="position: relative; z-index: 2;">
        <div class="row justify-content-center align-items-center g-4">
            
            <!-- Register Form Card - على اليسار -->
            <div class="col-lg-5 col-md-8 col-sm-10 order-lg-1">
                <div class="card border-0" style="border-radius: 20px; 
                                                   background: rgba(255, 255, 255, 0.98);
                                                   backdrop-filter: blur(15px);
                                                   box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);">
                    
                    <!-- Card Header -->
                    <div class="card-header text-center py-4" 
                         style="background: linear-gradient(135deg, rgba(33, 37, 41, 0.95) 0%, rgba(52, 58, 64, 0.95) 100%); 
                                border-radius: 20px 20px 0 0;
                                backdrop-filter: blur(10px);
                                border-bottom: 3px solid var(--bs-primary);">
                        <h3 class="mb-2 fw-bold font-playfair-display" style="color: var(--bs-primary);">Create Your Account</h3>
                        <p class="mb-0 font-work-sans" style="color: #ffffff; opacity: 0.9;">Join us today</p>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Full Name Input -->
                            <div class="mb-3">
                                <label for="name" class="form-label fw-semibold font-work-sans mb-2" style="color: #212529; font-size: 0.95rem;">
                                    Full Name
                                </label>
                                <input id="name" 
                                       type="text" 
                                       class="form-control form-control-lg register-input @error('name') is-invalid @enderror" 
                                       name="name" 
                                       value="{{ old('name') }}" 
                                       placeholder="Enter your full name"
                                       required 
                                       autocomplete="name" 
                                       autofocus
                                       style="border-radius: 12px; 
                                              padding: 12px 18px; 
                                              border: 2px solid #dee2e6;
                                              background: #f8f9fa;
                                              font-size: 0.95rem;
                                              color: #212529;">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Email Input -->
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold font-work-sans mb-2" style="color: #212529; font-size: 0.95rem;">
                                    Email Address
                                </label>
                                <input id="email" 
                                       type="email" 
                                       class="form-control form-control-lg register-input email-input @error('email') is-invalid @enderror" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       placeholder="Enter your email"
                                       required 
                                       autocomplete="email"
                                       style="border-radius: 12px; 
                                              padding: 12px 18px; 
                                              border: 2px solid var(--bs-primary);
                                              background: #ffffff;
                                              font-size: 0.95rem;
                                              color: #212529;">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Phone Input -->
                            <div class="mb-3">
                                <label for="phone" class="form-label fw-semibold font-work-sans mb-2" style="color: #212529; font-size: 0.95rem;">
                                    Phone Number
                                </label>
                                <input id="phone" 
                                       type="text" 
                                       class="form-control form-control-lg register-input @error('phone') is-invalid @enderror" 
                                       name="phone" 
                                       value="{{ old('phone') }}" 
                                       placeholder="Enter your phone number"
                                       required 
                                       autocomplete="tel"
                                       style="border-radius: 12px; 
                                              padding: 12px 18px; 
                                              border: 2px solid #dee2e6;
                                              background: #f8f9fa;
                                              font-size: 0.95rem;
                                              color: #212529;">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Password Input -->
                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold font-work-sans mb-2" style="color: #212529; font-size: 0.95rem;">
                                    Password
                                </label>
                                <input id="password" 
                                       type="password" 
                                       class="form-control form-control-lg register-input @error('password') is-invalid @enderror" 
                                       name="password" 
                                       placeholder="Create a password"
                                       required 
                                       autocomplete="new-password"
                                       style="border-radius: 12px; 
                                              padding: 12px 18px; 
                                              border: 2px solid #dee2e6;
                                              background: #f8f9fa;
                                              font-size: 0.95rem;
                                              color: #212529;">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Confirm Password Input -->
                            <div class="mb-4">
                                <label for="password-confirm" class="form-label fw-semibold font-work-sans mb-2" style="color: #212529; font-size: 0.95rem;">
                                    Confirm Password
                                </label>
                                <input id="password-confirm" 
                                       type="password" 
                                       class="form-control form-control-lg register-input" 
                                       name="password_confirmation" 
                                       placeholder="Confirm your password"
                                       required 
                                       autocomplete="new-password"
                                       style="border-radius: 12px; 
                                              padding: 12px 18px; 
                                              border: 2px solid #dee2e6;
                                              background: #f8f9fa;
                                              font-size: 0.95rem;
                                              color: #212529;">
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid mb-4">
                                <button type="submit" 
                                        class="btn btn-primary btn-lg fw-bold font-work-sans register-submit-btn" 
                                        style="border-radius: 12px; 
                                               padding: 15px;
                                               font-size: 1.1rem;
                                               letter-spacing: 0.5px;
                                               border: none;
                                               box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);">
                                    Register Now
                                </button>
                            </div>

                            <!-- Divider -->
                            <div class="position-relative my-4">
                                <hr style="border-top: 2px solid #dee2e6;">
                                <span class="position-absolute top-50 start-50 translate-middle px-3 text-muted small font-work-sans" 
                                      style="background: #ffffff; font-size: 0.85rem;">OR</span>
                            </div>

                            <!-- Login Link -->
                            <div class="text-center">
                                <p class="mb-0 font-work-sans" style="color: #495057; font-size: 0.95rem;">
                                    Already have an account? 
                                    <a href="{{ route('login') }}" 
                                       class="text-decoration-none fw-bold register-login-link"
                                       style="color: var(--bs-primary);">
                                        Login
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Welcome Message Section - على اليمين -->
            <div class="col-lg-5 d-none d-lg-block order-lg-2">
                <div class="welcome-section text-white">
                    <h1 class="display-3 fw-bold font-playfair-display mb-4" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.5); color: var(--bs-primary);">
                        Luxury Women's Salons
                    </h1>
                    <p class="lead font-work-sans mb-4" style="text-shadow: 1px 1px 4px rgba(0,0,0,0.5); font-size: 1.3rem;">
                        Join us for the ultimate beauty experience
                    </p>
                    <div class="mb-4">
                        <p class="font-work-sans mb-3" style="text-shadow: 1px 1px 4px rgba(0,0,0,0.5); font-size: 1.1rem;">
                            <i class="bi bi-check-circle-fill me-2" style="color: var(--bs-primary);"></i>
                            Expert Beauty Professionals
                        </p>
                        <p class="font-work-sans mb-3" style="text-shadow: 1px 1px 4px rgba(0,0,0,0.5); font-size: 1.1rem;">
                            <i class="bi bi-check-circle-fill me-2" style="color: var(--bs-primary);"></i>
                            Premium Salon Services
                        </p>
                        <p class="font-work-sans mb-3" style="text-shadow: 1px 1px 4px rgba(0,0,0,0.5); font-size: 1.1rem;">
                            <i class="bi bi-check-circle-fill me-2" style="color: var(--bs-primary);"></i>
                            Convenient Online Booking
                        </p>
                        <p class="font-work-sans mb-3" style="text-shadow: 1px 1px 4px rgba(0,0,0,0.5); font-size: 1.1rem;">
                            <i class="bi bi-check-circle-fill me-2" style="color: var(--bs-primary);"></i>
                            Exclusive VIP Treatment
                        </p>
                    </div>
                    <blockquote class="font-dancing-script" style="font-size: 1.5rem; border-left: 4px solid var(--bs-primary); padding-left: 20px; text-shadow: 1px 1px 4px rgba(0,0,0,0.5); color: var(--bs-primary);">
                        "Your Beauty, Our Passion"
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom Input Focus Effects - ONLY on FOCUS */
    .register-input:focus {
        border-color: var(--bs-primary) !important;
        box-shadow: 0 0 0 0.3rem rgba(212, 175, 55, 0.25) !important;
        background: #ffffff !important;
        transition: all 0.3s ease;
    }

    /* Email input special focus styling */
    .email-input:focus {
        border-color: var(--bs-primary) !important;
    }

    /* Card Hover Effect */
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 70px rgba(0, 0, 0, 0.6) !important;
    }

    /* Button Hover ONLY */
    .register-submit-btn {
        transition: all 0.3s ease;
    }

    .register-submit-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(212, 175, 55, 0.5) !important;
        background-color: #c9a745 !important;
    }

    /* Link Hover ONLY */
    .register-login-link {
        transition: all 0.3s ease;
    }

    .register-login-link:hover {
        color: #495057 !important;
        text-decoration: underline !important;
    }

    /* Welcome Section Animation */
    .welcome-section {
        animation: fadeInRight 0.8s ease-out;
    }

    @keyframes fadeInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Card Animation */
    .card {
        animation: fadeInLeft 0.8s ease-out;
    }

    @keyframes fadeInLeft {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Remove all hover effects from inputs */
    .register-input {
        transition: border-color 0.3s ease, box-shadow 0.3s ease, background 0.3s ease;
    }

    /* No hover effects on inputs - only on focus */
    .register-input:hover {
        /* Keep original styling, no changes on hover */
    }
</style>
@endsection