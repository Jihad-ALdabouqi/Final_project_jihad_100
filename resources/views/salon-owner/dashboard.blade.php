@extends('user.layouts.master')

@section('title', 'Salon Owner Dashboard')

@section('content')
<div class="container-fluid px-4 py-5">
    <!-- Welcome Header Section -->
    <div class="row mb-4 wow fadeInDown">
        <div class="col-12">
            <div class="card border-0 shadow-sm dashboard-header">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h2 class="mb-2 fw-bold text-white">
                                <i class="fas fa-wave-square me-2"></i>
                                Welcome, {{ Auth::user()->name }}!
                            </h2>
                            <p class="mb-3 text-white opacity-90">
                                <i class="fas fa-store me-2"></i>
                                Your Salon: <strong>{{ $salon->name ?? 'No Salon Created Yet' }}</strong>
                            </p>
                            <div class="btn-group">
                                @if($salon)
                                    <a href="{{ route('salon.owner.edit', $salon) }}" class="btn btn-light">
                                        <i class="fas fa-edit me-2"></i> Edit Salon Details
                                    </a>
                                @else
                                    <a href="{{ route('salon.owner.create') }}" class="btn btn-light">
                                        <i class="fas fa-plus me-2"></i> Create Your Salon Now
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4 text-end d-none d-md-block">
                            <i class="fas fa-cut fa-4x text-white opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Services Section -->
        <div class="col-lg-6 wow fadeInLeft">
            <div class="card border-0 shadow-sm h-100 dashboard-card">
                <div class="card-header bg-white border-0 pt-4 pb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-concierge-bell text-primary me-2"></i>
                            Your Services
                        </h5>
                        @if($salon)
                            <a href="{{ route('salon.owner.service.create', $salon) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus me-1"></i> Add Service
                            </a>
                        @else
                            <span class="badge bg-secondary">Create Salon First</span>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    @if($services->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($services as $service)
                                <div class="list-group-item border-0 px-0 py-3 service-item">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 fw-semibold">
                                                <i class="fas fa-spa text-muted me-2"></i>
                                                {{ $service->name }}
                                            </h6>
                                            <span class="badge bg-success">${{ number_format($service->price, 2) }}</span>
                                        </div>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('salon.owner.service.edit', [$salon, $service]) }}" 
                                               class="btn btn-outline-warning" 
                                               data-bs-toggle="tooltip" 
                                               title="Edit Service">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('salon.owner.service.destroy', [$salon, $service]) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-outline-danger" 
                                                        onclick="return confirm('Are you sure you want to delete this service?')"
                                                        data-bs-toggle="tooltip" 
                                                        title="Delete Service">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5 empty-state">
                            <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                            <p class="text-muted mb-0">No services available yet</p>
                            @if($salon)
                                <small class="text-secondary">Start by adding your first service</small>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Coin Requests Section -->
        <div class="col-lg-6 wow fadeInRight">
            <div class="card border-0 shadow-sm h-100 dashboard-card">
                <div class="card-header bg-white border-0 pt-4 pb-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-coins text-warning me-2"></i>
                        Pending Coin Requests
                    </h5>
                </div>
                <div class="card-body">
                    @if($requests->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($requests as $request)
                                <div class="list-group-item border-0 px-0 py-3 request-item">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-shrink-0">
                                            <div class="avatar-circle">
                                                {{ strtoupper(substr($request->user->name, 0, 1)) }}
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1 fw-semibold">{{ $request->user->name }}</h6>
                                            <p class="mb-1 text-muted small">
                                                <i class="fas fa-coins text-warning me-1"></i>
                                                Requesting <strong class="text-primary">{{ $request->coins }}</strong> coins
                                            </p>
                                            <small class="text-secondary">
                                                <i class="far fa-clock me-1"></i>
                                                {{ $request->created_at->diffForHumans() }}
                                            </small>
                                            <div class="mt-2">
                                                <form action="{{ route('salon.owner.request.approve', $request) }}" 
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm">
                                                        <i class="fas fa-check me-1"></i> Approve
                                                    </button>
                                                </form>
                                                <form action="{{ route('salon.owner.request.reject', $request) }}" 
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-times me-1"></i> Reject
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5 empty-state">
                            <i class="fas fa-check-circle fa-4x text-success mb-3"></i>
                            <p class="text-muted mb-0">No pending requests</p>
                            <small class="text-secondary">All caught up!</small>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Notifications Section -->
        <div class="col-12 wow fadeInUp">
            <div class="card border-0 shadow-sm dashboard-card">
                <div class="card-header bg-white border-0 pt-4 pb-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-bell text-info me-2"></i>
                        Discount Usage Notifications
                    </h5>
                </div>
                <div class="card-body">
                    @if($notifications->isEmpty())
                        <div class="text-center py-4 empty-state">
                            <i class="far fa-bell-slash fa-4x text-muted mb-3"></i>
                            <p class="text-muted mb-0">No recent discount notifications</p>
                            <small class="text-secondary">You'll be notified when customers redeem coins</small>
                        </div>
                    @else
                        <div class="list-group list-group-flush">
                            @foreach($notifications as $notification)
                                @if($notification->type == 'App\Notifications\CoinRedeemedNotification')
                                    <div class="list-group-item border-0 px-0 py-3 notification-item">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="notification-icon">
                                                    <i class="fas fa-gift"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1 fw-semibold">{{ $notification->data['title'] }}</h6>
                                                <p class="mb-1 text-muted small">{{ $notification->data['message'] }}</p>
                                                <small class="text-secondary">
                                                    <i class="far fa-clock me-1"></i>
                                                    {{ $notification->created_at->diffForHumans() }}
                                                </small>
                                            </div>
                                            <a href="{{ route('salon.owner.dashboard') }}" 
                                               class="btn btn-outline-primary btn-sm">
                                                View
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Dashboard Header Gradient */
    .dashboard-header {
        background: linear-gradient(135deg, #bf9456 0%, #bf9456 100%);
        position: relative;
        overflow: hidden;
    }
    
    .dashboard-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: rotate 20s linear infinite;
    }
    
    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    /* Card Styling */
    .dashboard-card {
        transition: all 0.3s ease;
        border-radius: 10px;
    }
    
    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
    }
    
    /* Avatar Circle */
    .avatar-circle {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.2rem;
        box-shadow: 0 2px 10px rgba(102, 126, 234, 0.3);
    }
    
    /* Notification Icon */
    .notification-icon {
        width: 45px;
        height: 45px;
        border-radius: 10px;
        background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        box-shadow: 0 2px 10px rgba(23, 162, 184, 0.3);
    }
    
    /* List Items Hover */
    .service-item,
    .request-item,
    .notification-item {
        transition: all 0.2s ease;
        border-radius: 8px;
        margin-bottom: 5px;
    }
    
    .service-item:hover,
    .request-item:hover,
    .notification-item:hover {
        background-color: #f8f9fa;
        padding-left: 10px !important;
    }
    
    /* Empty State */
    .empty-state {
        animation: fadeIn 0.5s ease;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    /* Button Styling */
    .btn-sm {
        padding: 0.4rem 0.8rem;
        font-size: 0.875rem;
        border-radius: 6px;
    }
    
    .btn-group-sm > .btn {
        padding: 0.35rem 0.6rem;
    }
    
    /* Badge Styling */
    .badge {
        padding: 0.4rem 0.8rem;
        font-weight: 500;
        border-radius: 6px;
    }
    
    /* Card Header */
    .card-header {
        border-bottom: 2px solid #f1f1f1;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .dashboard-header .col-md-4 {
            display: none !important;
        }
        
        .btn-group {
            flex-direction: column;
        }
        
        .btn-group .btn {
            width: 100%;
            margin-bottom: 5px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Add animation to counters if you want to show coin counts
    $('.counter').counterUp({
        delay: 10,
        time: 1000
    });
</script>
@endpush