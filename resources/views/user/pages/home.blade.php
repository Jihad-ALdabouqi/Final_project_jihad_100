@extends('user.layouts.master')

@section('title', 'Luxury Salons')

@section('content')
<!-- Hero Start -->
<div class="container-fluid p-0 hero-header bg-light mb-5">
    <div class="container p-0">
        <div class="row g-0 align-items-center">
            <div class="col-lg-6 hero-header-text py-5">
                <div class="py-5 px-3 ps-lg-0">
                    {{-- تأخير تحميل الصور غير المرئية --}}

                    <h1 class="font-dancing-script text-primary animated slideInLeft">Welcome</h1>
                    <h1 class="display-1 mb-4 animated slideInLeft">Discover Jordan’s Finest Woman’s Salons</h1>
                    <p class="fs-5 text-dark mb-4 animated slideInLeft">
                        Luxury Salons is your gateway to premium grooming destinations across Amman, Irbid, Aqaba, and beyond — each offering unique styles, expert barbers, and elite experiences.
                    </p>

                    @if($offer)
                    <div class="alert alert-success text-center mb-4 wow fadeIn" data-wow-delay="0.6s">
                        <strong>{{ $offer->title }}</strong><br>
                        {{ $offer->description }}
                    </div>
                    @endif

                    <div class="row g-4 animated slideInLeft">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="btn-square btn btn-primary flex-shrink-0">
                                    <i class="fa fa-phone text-dark"></i>
                                </div>
                                <div class="px-3">
                                    <h5 class="text-primary mb-0">Call Us</h5>
                                    <p class="fs-5 text-dark mb-0">+962 7 8290 1115</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="btn-square btn btn-primary flex-shrink-0">
                                    <i class="fa fa-envelope text-dark"></i>
                                </div>
                                <div class="px-3">
                                    <h5 class="text-primary mb-0">Email Us</h5>
                                    <p class="fs-5 text-dark mb-0">luxury_salons@gmail.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <img class="img-fluid w-100" src="{{ asset('img/hero-slider-1.jpg') }}" alt="Luxury Men's Salons" 
                style="border-radius: 30px !important; mr-5">
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->

<!-- About Start -->
<section id="about">
<div class="container-fluid py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.2s">
                <img class="img-fluid mb-3" src="{{ asset('img/about.jpg') }}" alt="About Luxury Salons" 
                style=" border-radius: 30px !important; ">
                <div class="d-flex align-items-center bg-light">
                    <div class="btn-square flex-shrink-0 bg-primary" style="width: 100px; height: 100px;">
                        <i class="fa fa-phone fa-2x text-dark"></i>
                    </div>
                    <div class="px-3">
                        <h3>+962 7 8290 1115</h3>
                        <span>Call for salon recommendations</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <h1 class="font-dancing-script text-primary">About Us</h1>
                <h1 class="mb-5">Why Choose Luxury Salons?</h1>
                <p class="mb-4">
                    We partner with only the most distinguished men’s grooming establishments in Jordan. Every featured salon meets our standards for quality, hygiene, and customer experience.
                </p>
                <div class="row g-3 mb-5">
                    <div class="col-sm-6">
                        <div class="bg-light text-center p-4">
                            <i class="fas fa-map-marked-alt fa-4x text-primary"></i>
                            <h1 class="display-5">{{ $salons->count() }}</h1>
                            <p class="text-dark text-uppercase mb-0">Premium Salons</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="bg-light text-center p-4">
                            <i class="fas fa-crown fa-4x text-primary"></i>
                            <h1 class="display-5">50+</h1>
                            <p class="text-dark text-uppercase mb-0">Elite Barbers</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->
</section>  
<section id="salons">
<!-- Salons Section Start -->
<div class="container-fluid service py-5">
    <div class="container">
        <div class="text-center wow fadeIn" data-wow-delay="0.1s">
            <h1 class="font-dancing-script text-primary">Our Salons</h1>
            <h1 class="mb-5">Explore Exclusive Grooming Destinations</h1>
        </div>
        <div class="row g-4" id="salons-container">
            @forelse($salons as $salon)
            <div class="col-md-6 col-lg-4 salon-card">
                <div class="card h-100 border-0 shadow-sm hover-shadow">
                    @if($salon->image_path)
                        <img src="{{asset($salon->image_path) }}" 
                             alt="{{ $salon->name }}" 
                             class="card-img-top" 
                             style="height: 250px; object-fit: cover; border-radius: 30px;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 150px;">
                            <i class="fas fa-store fa-3x text-secondary"></i>
                        </div>
                    @endif
                    <div class="card-body d-flex flex-column text-center p-5">
                        <h5 class="card-title">{{ $salon->name }}</h5>
                        <p class="card-text text-muted flex-grow-1">
                            {{ Str::limit($salon->description, 80) }}
                        </p>
                        <a href="{{ route('salon.show', $salon->id) }}" 
                           class="btn btn-outline-primary mt-auto">
                            <i class="fas fa-eye me-1"></i> View Salon
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="fas fa-store fa-3x text-muted mb-3"></i>
                <h5>No salons available yet.</h5>
            </div>
            @endforelse
        </div>

        <!-- Navigation Arrows -->
        @if($salons->count() > 3)
        <div class="text-center mt-4">
            <button id="prevBtn" class="btn btn-outline-secondary mx-2">&larr; Prev</button>
            <button id="nextBtn" class="btn btn-outline-secondary mx-2">Next &rarr;</button>
        </div>
        @endif
    </div>
</div>
<!-- Salons Section End -->
</section>
<!-- Pricing / Offers Section -->
@if($offer)
<div class="container-fluid price px-0 py-5">
    <div class="row g-0">
        <div class="col-md-6">
            <div class="d-flex align-items-center h-100 bg-primary p-5">
                <div class="wow fadeIn" data-wow-delay="0.3s">
                    <h1 class="font-dancing-script text-white">Special Offer</h1>
                    <h1 class="mb-0">Limited Time!</h1>
                    <h1 class="display-1 text-uppercase mb-5" style="letter-spacing: 10px;">{{ $offer->discount_percent }}% OFF</h1>
                    <p class="text-white fs-5">{{ $offer->description }}</p>
                    <a href="#" class="btn btn-dark mt-3">Claim Offer</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 bg-dark d-flex align-items-center justify-content-center">
            <div class="text-center p-5">
                <i class="fas fa-gift fa-5x text-primary mb-4"></i>
                <h3 class="text-white">{{ $offer->title }}</h3>
            </div>
        </div>
    </div>
</div>
@endif

<style>
.hover-shadow {
    transition: box-shadow 0.3s ease;
}
.hover-shadow:hover {
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('salons-container');
    if (!container) return;

    const cards = Array.from(container.querySelectorAll('.salon-card'));
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    let currentIndex = 0;
    const visibleCount = 3; // عرض 3 صالونات في الشاشة

    function updateDisplay() {
        const total = cards.length;
        cards.forEach((card, index) => {
            if (index >= currentIndex && index < currentIndex + visibleCount) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });

        prevBtn.disabled = currentIndex === 0;
        nextBtn.disabled = currentIndex + visibleCount >= total;
    }

    if (cards.length > visibleCount) {
        prevBtn.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex -= visibleCount;
                updateDisplay();
            }
        });

        nextBtn.addEventListener('click', () => {
            if (currentIndex + visibleCount < cards.length) {
                currentIndex += visibleCount;
                updateDisplay();
            }
        });

        updateDisplay();
    }
});
</script>
@endsection