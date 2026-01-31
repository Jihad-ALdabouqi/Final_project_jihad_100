@extends('admin.layout.master')

@section('content')
<div class="page-inner">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add New Salon</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('salons.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" name="location" class="form-control" value="{{ old('location') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" rows="5">{{ old('description') }}</textarea>
                    </div>

                    <!-- Phone -->
<div class="form-group">
    <label for="phone">Phone</label>
    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
</div>

<!-- Email -->
<div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
</div>

                    <!-- إضافة حقل رفع الصورة -->
                    <div class="form-group">
                        <label for="image_path">Image</label>
                        <input type="file" name="image_path" class="form-control" accept="image/*">
                        <small class="text-muted">Allowed formats: jpeg, png, jpg, gif. Max size: 2MB</small>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save Salon</button>
                        <a href="{{ route('salons.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection