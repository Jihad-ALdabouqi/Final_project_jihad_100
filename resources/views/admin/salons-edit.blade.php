@extends('admin.layout.master')

@section('content')
<div class="page-inner">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Salon: {{ $salon->name }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('salons.update', $salon->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $salon->name) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" name="location" class="form-control" value="{{ old('location', $salon->location) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" rows="5">{{ old('description', $salon->description) }}</textarea>
                    </div>
                    <!-- Phone -->
<div class="form-group">
    <label for="phone">Phone</label>
    <input type="text" name="phone" class="form-control" value="{{ old('phone', $salon->phone) }}">
</div>

<!-- Email -->
<div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', $salon->email) }}">
</div>

                    <!-- إضافة حقل الصورة -->
                    <div class="form-group">
                        <label for="image_path">Image</label>
                        <input type="file" name="image_path" class="form-control" accept="image/*">
                        <small class="text-muted">Leave blank to keep current image</small>

                        @if($salon->image_path)
                            <div class="mt-2">
                                <p>Current Image:</p>
                                <img src="{{ asset($salon->image_path) }}" alt="Current Image" width="150">
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update Salon</button>
                        <a href="{{ route('salons.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection