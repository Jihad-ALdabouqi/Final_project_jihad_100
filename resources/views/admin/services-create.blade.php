@extends('admin.layout.master')

@section('content')
<div class="page-inner">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add New Service</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="salon_id">Salon</label>
                        <select name="salon_id" class="form-control" required>
                            <option value="">Select Salon</option>
                            @foreach($salons as $salon)
                                <option value="{{ $salon->id }}">{{ $salon->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="price">Price ($)</label>
                        <input type="number" step="0.01" name="price" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="coin_cost">Coin Cost</label>
                        <input type="number" name="coin_cost" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="coins_earned">Coins Earned</label>
                        <input type="number" name="coins_earned" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="is_active">Active</label>
                        <select name="is_active" class="form-control">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save Service</button>
                        <a href="{{ route('services.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection