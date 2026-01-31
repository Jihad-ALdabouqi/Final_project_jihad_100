@extends('admin.layout.master')

@section('content')
<div class="page-inner">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Add New Feedback</h4>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('feedbacks.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user_id">User</label>
                                <select name="user_id" class="form-control" required>
                                    <option value="">Select User</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="salon_id">Salon</label>
                                <select name="salon_id" class="form-control" required>
                                    <option value="">Select Salon</option>
                                    @foreach($salons as $salon)
                                        <option value="{{ $salon->id }}">{{ $salon->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rating">Rating (1-5)</label>
                                <select name="rating" class="form-control" required>
                                    <option value="1">★☆☆☆☆ (1)</option>
                                    <option value="2">★★☆☆☆ (2)</option>
                                    <option value="3">★★★☆☆ (3)</option>
                                    <option value="4">★★★★☆ (4)</option>
                                    <option value="5">★★★★★ (5)</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="comment">Comment (Optional)</label>
                                <textarea name="comment" class="form-control" rows="3" maxlength="1000"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-success">Save Feedback</button>
                        <a href="{{ route('feedbacks.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection