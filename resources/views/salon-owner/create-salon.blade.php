@extends('user.layouts.master')

@section('title', 'Create New Salon')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">🌟 Create Your Own Salon</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('salon.owner.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Salon Name *</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="e.g. Mohammad Salon" required>
                        </div>

                        <div class="mb-3">
                            <label for="location" class="form-label">Location *</label>
                            <input type="text" name="location" id="location" class="form-control" placeholder="e.g. Amman, Jordan" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="0782901115">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="mohammad@gmail.com">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Salon Description</label>
                            <textarea name="description" id="description" class="form-control" rows="4" placeholder="Tell us about your salon..."></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image_path" class="form-label">Salon Image</label>
                            <input type="file" name="image_path" id="image_path" class="form-control" accept="image/*">
                            <small class="form-text text-muted">Preferred image size: 800x600 pixels.</small>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-plus-circle me-2"></i> Create Salon
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
