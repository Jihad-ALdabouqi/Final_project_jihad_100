@extends('admin.layout.master')

@section('content')
<div class="page-inner">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Edit Feedback</h4>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('feedbacks.update', $feedback) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user_id">User</label>
                                <select name="user_id" class="form-control" required>
                                    <option value="">Select User</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ $user->id == $feedback->user_id ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ $user->email }})
                                        </option>
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
                                        <option value="{{ $salon->id }}" {{ $salon->id == $feedback->salon_id ? 'selected' : '' }}>
                                            {{ $salon->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rating">Rating (1-5)</label>
                                <select name="rating" class="form-control" required>
                                    <option value="1" {{ $feedback->rating == 1 ? 'selected' : '' }}>★☆☆☆☆ (1)</option>
                                    <option value="2" {{ $feedback->rating == 2 ? 'selected' : '' }}>★★☆☆☆ (2)</option>
                                    <option value="3" {{ $feedback->rating == 3 ? 'selected' : '' }}>★★★☆☆ (3)</option>
                                    <option value="4" {{ $feedback->rating == 4 ? 'selected' : '' }}>★★★★☆ (4)</option>
                                    <option value="5" {{ $feedback->rating == 5 ? 'selected' : '' }}>★★★★★ (5)</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="comment">Comment (Optional)</label>
                                <textarea name="comment" class="form-control" rows="3" maxlength="1000">{{ old('comment', $feedback->comment) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-success">Update Feedback</button>
                        <a href="{{ route('feedbacks.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection