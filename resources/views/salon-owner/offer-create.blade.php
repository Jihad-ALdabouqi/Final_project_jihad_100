@extends('user.layouts.master')

@section('title', 'Add New Offer to: ' . $salon->name)

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Add New Offer to: {{ $salon->name }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('salon.owner.offer.store', $salon) }}" method="POST">
                        @csrf

                        <div class="mb-3">
    <label for="service_id" class="form-label">Select Service</label>
    <select name="service_id" id="service_id" class="form-control" required>
        <option value="">Choose a service...</option>
        @foreach($services as $service)
            <option value="{{ $service->id }}">{{ $service->name }} - ${{ number_format($service->price, 2) }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="name" class="form-label">Offer Name (Optional)</label>
    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
    <small class="text-muted">Leave empty to use service name</small>
</div>

                        <div class="mb-3">
                            <label for="required_coins" class="form-label">Required Coins</label>
                            <input type="number" name="required_coins" id="required_coins" class="form-control" value="{{ old('required_coins') }}" min="0" required>
                        </div>

                        <div class="mb-3">
                            <label for="discount_percentage" class="form-label">Discount Percentage (%)</label>
                            <input type="number" name="discount_percentage" id="discount_percentage" class="form-control" value="{{ old('discount_percentage') }}" min="0" max="100" required>
                        </div>

                        <button type="submit" class="btn btn-success">Create Offer</button>
                        <a href="{{ route('salon.owner.dashboard') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection