@extends('user.layouts.master')

@section('title', 'Login')

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
            
            <!-- Welcome Message Section -->
            <div class="col-lg-5 d-none d-lg-block">
                <div class="welcome-section text-white">
                    <h1 class="display-3 fw-bold font-playfair-display mb-4" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.5); color: var(--bs-primary);">
                        Luxury Women's Salons
                    </h1>
                    <p class="lead font-work-sans mb-4" style="text-shadow: 1px 1px 4px rgba(0,0,0,0.5); font-size: 1.3rem;">
                        Welcome to the ultimate beauty experience
                    </p>
                    <div class="mb-4">
                        <p class="font-work-sans mb-3" style="text-shadow: 1px 1px 4px rgba(0,0,0,0.5); font-size: 1.1rem;">
                            <i class="bi bi-check-circle-fill me-2" style="color: var(--bs-primary);"></i>
                            Professional Stylists
                        </p>
                        <p class="font-work-sans mb-3" style="text-shadow: 1px 1px 4px rgba(0,0,0,0.5); font-size: 1.1rem;">
                            <i class="bi bi-check-circle-fill me-2" style="color: var(--bs-primary);"></i>
                            Premium Beauty Services
                        </p>
                        <p class="font-work-sans mb-3" style="text-shadow: 1px 1px 4px rgba(0,0,0,0.5); font-size: 1.1rem;">
                            <i class="bi bi-check-circle-fill me-2" style="color: var(--bs-primary);"></i>
                            Easy Online Booking
                        </p>
                        <p class="font-work-sans mb-3" style="text-shadow: 1px 1px 4px rgba(0,0,0,0.5); font-size: 1.1rem;">
                            <i class="bi bi-check-circle-fill me-2" style="color: var(--bs-primary);"></i>
                            Luxury Experience
                        </p>
                    </div>
                    <blockquote class="font-dancing-script" style="font-size: 1.5rem; border-left: 4px solid var(--bs-primary); padding-left: 20px; text-shadow: 1px 1px 4px rgba(0,0,0,0.5); color: var(--bs-primary);">
                        "Where Style Meets Sophistication"
                    </blockquote>
                </div>
            </div>

            <!-- Login Form Card -->
            <div class="col-lg-5 col-md-8 col-sm-10">
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
                        <h3 class="mb-2 fw-bold font-playfair-display" style="color: var(--bs-primary);">Sign in to continue</h3>
                        <p class="mb-0 font-work-sans" style="color: #ffffff; opacity: 0.9;">Welcome Back</p>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        <!-- Alert Messages -->
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert" style="border-radius: 12px; border-left: 4px solid #dc3545;">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert" style="border-radius: 12px; border-left: 4px solid #198754;">
                                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email Input -->
                            <div class="mb-4">
                                <label for="email" class="form-label fw-semibold font-work-sans mb-2" style="color: #212529; font-size: 0.95rem;">
                                    Email Address
                                </label>
                                <input id="email" 
                                       type="email" 
                                       class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       placeholder="Enter your email"
                                       required 
                                       autocomplete="email" 
                                       autofocus
                                       style="border-radius: 12px; 
                                              padding: 14px 20px; 
                                              border: 2px solid var(--bs-primary);
                                              background: #ffffff;
                                              font-size: 1rem;
                                              color: #212529;">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Password Input -->
                            <div class="mb-4">
                                <label for="password" class="form-label fw-semibold font-work-sans mb-2" style="color: #212529; font-size: 0.95rem;">
                                    Password
                                </label>
                                <input id="password" 
                                       type="password" 
                                       class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                       name="password" 
                                       placeholder="Enter your password"
                                       required 
                                       autocomplete="current-password"
                                       style="border-radius: 12px; 
                                              padding: 14px 20px; 
                                              border: 2px solid #dee2e6;
                                              background: #f8f9fa;
                                              font-size: 1rem;
                                              color: #212529;">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Remember Me -->
                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           name="remember" 
                                           id="remember" 
                                           {{ old('remember') ? 'checked' : '' }}
                                           style="border-radius: 5px; 
                                                  width: 20px; 
                                                  height: 20px; 
                                                  border: 2px solid #495057;
                                                  cursor: pointer;">
                                    <label class="form-check-label ms-2 font-work-sans" for="remember" style="color: #495057; font-size: 0.95rem; cursor: pointer;">
                                        Remember Me
                                    </label>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid mb-4">
                                <button type="submit" 
                                        class="btn btn-primary btn-lg fw-bold font-work-sans" 
                                        style="border-radius: 12px; 
                                               padding: 15px;
                                               transition: all 0.3s ease;
                                               position: relative;
                                               font-size: 1.1rem;
                                               letter-spacing: 0.5px;
                                               border: none;
                                               box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);">
                                    Login
                                </button>
                            </div>

                            <!-- Divider -->
                            <div class="position-relative my-4">
                                <hr style="border-top: 2px solid #dee2e6;">
                                <span class="position-absolute top-50 start-50 translate-middle px-3 text-muted small font-work-sans" 
                                      style="background: #ffffff; font-size: 0.85rem;">OR</span>
                            </div>

                            <!-- Register Link -->
                            <div class="text-center">
                                <p class="mb-0 font-work-sans" style="color: #495057; font-size: 0.95rem;">
                                    Don't have an account? 
                                    <a href="{{ route('register') }}" 
                                       class="text-decoration-none fw-bold"
                                       style="color: var(--bs-primary); transition: all 0.3s ease;">
                                        Register Now
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom Input Focus Effects */
    .form-control:focus {
        border-color: var(--bs-primary) !important;
        box-shadow: 0 0 0 0.3rem rgba(212, 175, 55, 0.25) !important;
        background: #ffffff !important;
    }

    /* Smooth Transitions */
    .form-control, .btn {
        transition: all 0.3s ease;
    }

    /* Card Hover Effect */
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 70px rgba(0, 0, 0, 0.6) !important;
    }

    /* Custom Checkbox */
    .form-check-input:checked {
        background-color: var(--bs-primary);
        border-color: var(--bs-primary);
    }

    .form-check-input:focus {
        border-color: var(--bs-primary);
        box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.25);
    }

    /* Button Hover */
    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(212, 175, 55, 0.5) !important;
        background-color: #c9a745 !important;
    }

    /* Link Hover */
    a[href="{{ route('register') }}"]:hover {
        color: #495057 !important;
        text-decoration: underline !important;
    }

    /* Input Hover */
    .form-control:hover {
        border-color: var(--bs-primary);
    }

    /* Welcome Section Animation */
    .welcome-section {
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

    /* Card Animation */
    .card {
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
</style>
@endsection