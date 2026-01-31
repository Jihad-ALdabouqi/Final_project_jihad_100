@extends('admin.layout.master')

@section('content')
<div class="page-inner">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Feedbacks</h4>
                    <a href="{{ route('feedbacks.create') }}" class="btn btn-primary btn-round ms-auto">
                        <i class="fa fa-plus"></i> Add Feedback
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Salon</th>
                                <th>Rating</th>
                                <th>Comment</th>
                                <th>Created At</th>
                                <th style="width: 10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($feedbacks as $fb)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $fb->user?->name ?? '—' }}</td>
                                <td>{{ $fb->salon?->name ?? '—' }}</td>
                                <td>
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $fb->rating ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                                </td>
                                <td>{{ Str::limit($fb->comment ?? '—', 50, '...') }}</td>
                                <td>{{ $fb->created_at->format('Y-m-d H:i') }}</td>
                                <td>
                                    <div class="form-button-action">
                                        <a href="{{ route('feedbacks.edit', $fb->id) }}" class="btn btn-link btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('feedbacks.destroy', $fb->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link btn-danger" onclick="return confirm('Delete this feedback?')">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $feedbacks->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection