@extends('user.layouts.master')

@section('title', $service->name . ' - ' . $salon->name)

@section('content')
<div class="container py-5">
    <!-- Service Header -->
    <div class="row mb-5">
        <div class="col-lg-6 text-center">
            @if($service->image)
                <img src="{{ Storage::url($service->image) }}" 
                 alt="{{ $service->name }}"  
                     class="card-img-top" 
                     style="height: 500px; object-fit: cover; border-radius: 30px;">
            @else
                <div class="bg-light d-flex align-items-center justify-content-center" style="height: 300px;">
                    <i class="fas fa-scissors fa-5x text-secondary"></i>
                </div>
            @endif
        </div>
        <div class="col-lg-6 d-flex flex-column justify-content-center">
            <h1 class="font-dancing-script text-primary display-5">{{ $service->name }}</h1>
            <p class="fs-5 text-muted mb-3">
                <i class="fas fa-store me-2"></i>{{ $salon->name }}
            </p>
            <p class="lead">{{ $service->description }}</p>

<!-- Service Details -->
<div class="mt-4 p-3 bg-light rounded">
    <h5 class="mb-3"><i class="fas fa-info-circle text-primary me-2"></i>Service Details</h5>
    <ul class="list-unstyled">
        <li class="mb-2"><i class="fas fa-tag me-2 text-primary"></i> Price: {{ $service->price }} JOD</li>
        @if($service->coin_cost > 0)
            <li class="mb-2"><i class="fas fa-coins me-2 text-warning"></i> Requires: {{ $service->coin_cost }} Coins</li>
            <li class="mb-2"><i class="fas fa-percentage me-2 text-success"></i> Discount: {{ $service->discount }} %</li>
            <li class="mb-2"><i class="fas fa-receipt me-2 text-info"></i> Final Price: {{ max(0, $service->price - ($service->price * $service->discount / 100)) }} JOD</li>
        @endif
        @if($service->coins_earned > 0)
            <li class="mb-2"><i class="fas fa-gift me-2 text-success"></i> Earns after approval: {{ $service->coins_earned }} Coins</li>
        @endif
    </ul>

    @auth
        @php
            $userCoins = auth()->user()->coins;
            $canAfford = $service->coin_cost == 0 || $userCoins >= $service->coin_cost;
        @endphp

        @if($service->coin_cost > 0)
            <div class="alert alert-info mt-3">
                Your Coins: <strong>{{ $userCoins }}</strong>
                @if(!$canAfford)
                    <br><small class="text-danger">You need {{ $service->coin_cost }} coins.</small>
                @endif
            </div>
        @endif

        @if($canAfford)
            <!-- زر خصم الكوينز فوراً -->
            <form action="{{ route('coin.redeem.store', $service->id) }}" method="POST" class="mt-3">
                @csrf
                <button type="submit" class="btn btn-success w-100">
                    <i class="fas fa-coins me-2"></i> 
                    Use {{ $service->coin_cost }} Coins & Pay {{max(0, $service->price - ($service->price * $service->discount / 100)) }} JOD
                </button>
            </form>
        @else
            <button class="btn btn-secondary w-100" disabled>
                <i class="fas fa-coins me-2"></i> Insufficient Coins
            </button>
        @endif

        <!-- زر طلب الكوينز (بدون خصم فوري) -->
        <form action="{{ route('coin.request.store', $service->id) }}" method="POST" class="mt-3">
            @csrf
            <button type="submit" class="btn btn-outline-primary w-100">
                <i class="fas fa-envelope me-2"></i> Request Coins (No Immediate Deduction)
            </button>
        </form>
    @else
        <div class="alert alert-info mt-3">
            <a href="{{ route('login') }}" class="text-decoration-none">Log in</a> to book.
        </div>
    @endauth
</div>
        </div>
    </div>
<!-- Offer Section -->
@if($offer)
    <div class="mt-4 p-3 bg-success text-white rounded">
        <h5><i class="fas fa-gift me-2"></i> Special Offer!</h5>
        <p><strong>{{ $offer->name }}</strong></p>
        <ul class="list-unstyled">
            <li><i class="fas fa-coins me-2"></i> Requires: {{ $offer->required_coins }} Coins</li>
            <li><i class="fas fa-percentage me-2"></i> Discount: {{ $offer->discount_percentage }}%</li>
            <li><i class="fas fa-tag me-2"></i> Final Price: 
                @php
                    $finalPrice = max(0, $service->price - ($service->price * $offer->discount_percentage / 100));
                @endphp
                {{ number_format($finalPrice, 2) }} JOD
            </li>
        </ul>
    </div>
@endif

    <!-- Salon Info -->
    <div class="row mt-5">
        <div class="col">
            <div class="bg-light p-4 rounded shadow">
                <h3>Contact {{ $salon->name }}</h3>
                <p><i class="fa fa-phone me-2"></i>Phone: {{ $salon->phone }}</p>
                <p><i class="fa fa-envelope me-2"></i>Email: {{ $salon->email }}</p>
                <p><i class="fa fa-map-marker-alt me-2"></i>Address: {{ $salon->location }}</p>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('salon.show', $salon->id) }}" class="btn btn-primary px-4">
            <i class="fas fa-arrow-left me-1"></i> Back to Salon
        </a>
    </div>
</div>
@endsection