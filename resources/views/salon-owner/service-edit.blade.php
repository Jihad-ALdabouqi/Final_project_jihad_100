@extends('user.layouts.master')

@section('title', 'Edit Service: ' . $service->name)

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Service: {{ $service->name }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('salon.owner.service.update', [$salon, $service]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Service Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $service->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Price ($)</label>
                            <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ old('price', $service->price) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="coin_cost" class="form-label">Coin Cost (optional)</label>
                            <input type="number" name="coin_cost" id="coin_cost" class="form-control" value="{{ old('coin_cost', $service->coin_cost) }}">
                            <small class="text-muted">How many coins needed to book this service</small>
                        </div>

                        <div class="mb-3">
                            <label for="coins_earned" class="form-label">Coins Earned (optional)</label>
                            <input type="number" name="coins_earned" id="coins_earned" class="form-control" value="{{ old('coins_earned', $service->coins_earned) }}">
                            <small class="text-muted">How many coins user earns after booking</small>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control">{{ old('description', $service->description) }}</textarea>
                        </div>

                         <div class="mb-3">
                            <label for="discount" class="form-label">Discount (%)</label>
                            <input type="number" name="discount" id="discount" class="form-control" value="{{ old('discount', $service->discount) }}">
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Change Image (optional)</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                            @if($service->image)
                                <div class="mt-2">
                                    <p>Current Image:</p>
                                    <img src="{{ asset('storage/' . $service->image) }}" alt="Service Image" width="150">
                                </div>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Update Service</button>
                        <a href="{{ route('salon.owner.dashboard') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection