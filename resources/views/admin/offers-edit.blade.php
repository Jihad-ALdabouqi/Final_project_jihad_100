@extends('admin.layout.master')

@section('content')
<div class="page-inner">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Edit Offer</h4>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('offers.update', $offer) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Offer Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $offer->name) }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="salon_id">Salon</label>
                                <select name="salon_id" class="form-control" required>
                                    <option value="">Select Salon</option>
                                    @foreach($salons as $salon)
                                        <option value="{{ $salon->id }}" {{ $salon->id == $offer->salon_id ? 'selected' : '' }}>
                                            {{ $salon->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="required_coins">Required Coins</label>
                                <input type="number" name="required_coins" class="form-control" value="{{ old('required_coins', $offer->required_coins) }}" min="1" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="discount_percentage">Discount Percentage (%)</label>
                                <input type="number" name="discount_percentage" class="form-control" value="{{ old('discount_percentage', $offer->discount_percentage) }}" min="0" max="100" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-check">
                                <input type="checkbox" name="is_active" id="is_active" class="form-check-input" {{ $offer->is_active ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Active</label>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-success">Update Offer</button>
                        <a href="{{ route('offers.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection