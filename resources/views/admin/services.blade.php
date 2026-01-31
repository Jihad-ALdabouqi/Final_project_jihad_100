@extends('admin.layout.master')

@section('content')
<div class="page-inner">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Services Management</h4>
                    <a href="{{ route('services.create') }}" class="btn btn-primary btn-round ms-auto">
                        <i class="fa fa-plus"></i> Add Service
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
                                <th>Salon</th>
                                <th>Price</th>
                                <th>Coin Cost</th>
                                <th>Coins Earned</th>
                                <th>Active</th>
                                <th>Image</th>
                                <th style="width: 10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($services as $service)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $service->name }}</td>
                                <td>{{ $service->salon->name ?? 'N/A' }}</td>
                                <td>${{ number_format($service->price, 2) }}</td>
                                <td>{{ $service->coin_cost }}</td>
                                <td>{{ $service->coins_earned }}</td>
                                <td>
                                    <span class="badge bg-{{ $service->is_active ? 'success' : 'danger' }}">
                                        {{ $service->is_active ? 'Yes' : 'No' }}
                                    </span>
                                </td>
                                <td>
                                    @if($service->image)
                                        <img src="{{ Storage::url($service->image) }}" width="50" height="50" alt="Service Image">
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    <div class="form-button-action">
                                        <a href="{{ route('services.edit', $service->id) }}" class="btn btn-link btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link btn-danger" onclick="return confirm('Delete this service?')">
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
                    {{ $services->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection