@extends('admin.layout.master')

@section('content')
<div class="page-inner">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Coin Transactions</h4>
                    <a href="{{ route('coin-transactions.create') }}" class="btn btn-primary btn-round ms-auto">
                        <i class="fa fa-plus"></i> Add Transaction
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
                                <th>Service</th>
                                <th>Salon</th>
                                <th>Coins</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th style="width: 10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $tx)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $tx->user?->name ?? '—' }}</td>
                                <td>{{ $tx->service?->name ?? '—' }}</td>
                                <td>{{ $tx->salon?->name ?? '—' }}</td>
                                <td>
                                    <span class="{{ $tx->coins >= 0 ? 'text-success' : 'text-danger' }}">
                                        {{ $tx->coins >= 0 ? '+' . $tx->coins : $tx->coins }}
                                    </span>
                                </td>
                                <td>
                                    @if($tx->type === 'earn')
                                        <span class="badge bg-success">Earn</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Redeem</span>
                                    @endif
                                </td>
                                <td>
                                    @if($tx->status === 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($tx->status === 'confirmed')
                                        <span class="badge bg-success">Confirmed</span>
                                    @else
                                        <span class="badge bg-danger">Rejected</span>
                                    @endif
                                </td>
                                <td>{{ $tx->created_at->format('Y-m-d H:i') }}</td>
                                <td>
                                    <div class="form-button-action">
                                        <a href="{{ route('coin-transactions.edit', $tx->id) }}" class="btn btn-link btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('coin-transactions.destroy', $tx->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link btn-danger" onclick="return confirm('Delete this transaction?')">
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
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection