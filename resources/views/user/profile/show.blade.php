@extends('user.layouts.master')

@section('title', 'My Profile')

@section('content')
<div class="container py-5">
    <h2 class="font-dancing-script text-primary display-5 mb-4">My Profile</h2>

    <!-- SweetAlert for success -->
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif

    <div class="row">
        <!-- Edit Profile Info -->
        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title mb-4"><i class="fas fa-user-edit me-2 text-primary"></i> Edit Profile</h5>
                    <form action="{{ route('profile.update.info') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}">
                            @error('name')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}">
                            @error('email')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone (Optional)</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                        </div>

                        <button type="submit" class="btn btn-primary px-4 rounded-pill">
                            <i class="fas fa-save me-1"></i> Save Changes
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Change Password -->
        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title mb-4"><i class="fas fa-key me-2 text-primary"></i> Change Password</h5>
                    <form action="{{ route('profile.update.password') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password">
                            @error('current_password')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password">
                            @error('new_password')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                        </div>

                        <button type="submit" class="btn btn-warning px-4 rounded-pill text-white">
                            <i class="fas fa-lock me-1"></i> Update Password
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Coins Summary (Optional but nice) -->
    <div class="row mt-4">
        <div class="col">
            <div class="alert alert-info d-flex align-items-center">
                <i class="fas fa-coins me-2 fa-lg"></i>
                <div>
                    <strong>Your Coins:</strong> {{ $user->coins }} coins
                    @if($user->coins > 0)
                        <br><small>You can use them to get discounts on services.</small>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection