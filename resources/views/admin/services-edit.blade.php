@extends('admin.layout.master')

@section('content')
<div class="page-inner">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Service: {{ $service->name }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="salon_id">Salon</label>
                        <select name="salon_id" class="form-control" required>
                            <option value="">Select Salon</option>
                            @foreach($salons as $salon)
                                <option value="{{ $salon->id }}" {{ $salon->id == $service->salon_id ? 'selected' : '' }}>
                                    {{ $salon->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $service->name) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="price">Price ($)</label>
                        <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $service->price) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="coin_cost">Coin Cost</label>
                        <input type="number" name="coin_cost" class="form-control" value="{{ old('coin_cost', $service->coin_cost) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="coins_earned">Coins Earned</label>
                        <input type="number" name="coins_earned" class="form-control" value="{{ old('coins_earned', $service->coins_earned) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="is_active">Active</label>
                        <select name="is_active" class="form-control">
                            <option value="1" {{ $service->is_active ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ !$service->is_active ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" class="form-control">
                        @if($service->image)
                            <img src="{{ Storage::url($service->image) }}" width="100" height="100" class="mt-2">
                        @endif
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update Service</button>
                        <a href="{{ route('services.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection