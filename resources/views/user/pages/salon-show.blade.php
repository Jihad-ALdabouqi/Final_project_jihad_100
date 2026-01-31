@extends('user.layouts.master')

@section('title', $salon->name . ' - Luxury Salons')

@section('content')
<div class="container py-5">
    <!-- Salon Info Card -->
    <div class="row mb-5">
        <div class="col-lg-6 text-center mb-4 mb-lg-0">
            @if($salon->image_path)
                <img src="{{ asset($salon->image_path) }}" alt="{{ $salon->name }}" 
                     class="img-fluid rounded shadow" 
                     style="max-height: 440px; width: 100%; object-fit: cover; border-radius: 30px !important;">
            @else
                <img src="{{ asset('img/default-salon.jpg') }}" alt="Default Salon" 
                     class="img-fluid rounded shadow" 
                     style="max-height: 320px; width: 100%; object-fit: cover;">
            @endif
        </div>
        <div class="col-lg-6 d-flex flex-column justify-content-center">
            <h1 class="font-dancing-script text-primary display-5">{{ $salon->name }}</h1>
            <p class="fs-5 text-muted mb-3">
                <i class="fas fa-map-marker-alt me-2"></i>{{ $salon->location }}
            </p>
            <p class="lead">{{ $salon->description }}</p>

            <div class="mt-4 p-3 bg-light rounded">
                <h5 class="mb-3"><i class="fas fa-info-circle text-primary me-2"></i>Contact Details</h5>
                <ul class="list-unstyled">
                    @if($salon->phone)
                        <li class="mb-2"><i class="fas fa-phone me-2 text-primary"></i> {{ $salon->phone }}</li>
                    @endif
                    @if($salon->email)
                        <li class="mb-2"><i class="fas fa-envelope me-2 text-primary"></i> {{ $salon->email }}</li>
                    @endif
                    <li><i class="fas fa-map-marked-alt me-2 text-primary"></i> {{ $salon->location }}</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Services Section -->
    <div class="mb-5">
        <div class="text-center mb-4">
            <h2 class="font-dancing-script text-primary">Our Services</h2>
            <p class="text-muted">Browse our premium grooming services</p>
        </div>

        @if($salon->services->count())
            <div class="row g-4" id="services-container">
                @foreach($salon->services as $service)
                <div class="col-md-6 col-lg-3 service-card  border-radius: 30px !important;">
                    <div class="card h-100 border-0 shadow-sm hover-shadow   border-radius: 30px !important;">
                        @if($service->image)
                            <img src="{{ Storage::url($service->image) }}" 
     alt="{{ $service->name }}" 
                                 class="card-img-top" 
                                 style="height: 230px; object-fit: cover;  border-radius: 30px;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 150px;">
                                <i class="fas fa-scissors fa-3x text-secondary"></i>
                            </div>
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-center p-3">{{ $service->name }}</h5>
                            <p class="card-text text-muted flex-grow-1">
                                {{ Str::limit($service->description, 80) }}
                            </p>
                            <a href="{{ route('service.show', [$salon->id, $service->id]) }}" 
                               class="btn btn-outline-primary mt-auto">
                                <i class="fas fa-eye me-1"></i> View Service
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- Offer Section -->


            <!-- Navigation Arrows -->
            @if($salon->services->count() > 4)
            <div class="text-center mt-4">
                <button id="prevBtn" class="btn btn-outline-secondary mx-2">&larr; Prev</button>
                <button id="nextBtn" class="btn btn-outline-secondary mx-2">Next &rarr;</button>
            </div>
            @endif
        @else
            <div class="text-center py-5">
                <i class="fas fa-concierge-bell fa-3x text-muted mb-3"></i>
                <h5>No services available yet.</h5>
            </div>
        @endif
    </div>

    <div class="text-center">
        <a href="{{ route('home') }}" class="btn btn-primary px-4 py-2">
            <i class="fas fa-arrow-left me-1"></i> Back to All Salons
        </a>
    </div>
</div>

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
    const container = document.getElementById('services-container');
    const cards = Array.from(container.querySelectorAll('.service-card'));
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    let currentIndex = 0;
    const visibleCount = 4;

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