@extends('admin.layout.master')

@section('content')
<div class="page-inner">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Offers</h4>
                    <a href="{{ route('offers.create') }}" class="btn btn-primary btn-round ms-auto">
                        <i class="fa fa-plus"></i> Add Offer
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
                                <th>Required Coins</th>
                                <th>Discount (%)</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th style="width: 10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($offers as $offer)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $offer->name }}</td>
                                <td>{{ $offer->salon?->name ?? '—' }}</td>
                                <td>{{ $offer->required_coins }}</td>
                                <td>{{ $offer->discount_percentage }}%</td>
                                <td>
                                    @if($offer->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ $offer->created_at->format('Y-m-d H:i') }}</td>
                                <td>
                                    <div class="form-button-action">
                                        <a href="{{ route('offers.edit', $offer->id) }}" class="btn btn-link btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('offers.destroy', $offer->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link btn-danger" onclick="return confirm('Delete this offer?')">
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
                    {{ $offers->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection