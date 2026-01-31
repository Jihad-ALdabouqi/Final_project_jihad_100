@extends('admin.layout.master')

@section('content')
<div class="page-inner">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Salons Management</h4>
                    <a href="{{ route('salons.create') }}" class="btn btn-primary btn-round ms-auto">
                        <i class="fa fa-plus"></i> Add Salon
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Location</th>
                                <th>Description</th>
                                <th>Phone</th>
<th>Email</th>
                                <th>Image</th>
                                <th>Created At</th>
                                <th style="width: 10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($salons as $salon)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $salon->name }}</td>
                                <td>{{ Str::limit($salon->location, 30, '...') }}</td>
                                <td>{{ Str::limit($salon->description, 30, '...') }}</td>
                                <td>{{ $salon->phone ?? 'N/A' }}</td>
<td>{{ $salon->email ?? 'N/A' }}</td>
                                <td>
    @if($salon->image)
        <img src="{{ Storage::url($salon->image) }}" alt="Salon Image" width="50" height="50" style="object-fit: cover;">
    @else
        <span class="badge bg-warning">No Image</span>
    @endif
</td>
                                <td>{{ $salon->created_at->format('Y-m-d H:i') }}</td>
                                <td>
                                    <div class="form-button-action">
                                        <a href="{{ route('salons.edit', $salon->id) }}" class="btn btn-link btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('salons.destroy', $salon->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link btn-danger" onclick="return confirm('Delete this salon?')">
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

                <!-- Pagination -->
                <div class="mt-3">
                    {{ $salons->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection