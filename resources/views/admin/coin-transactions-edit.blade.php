@extends('admin.layout.master')

@section('content')
<div class="container-fluid">
    <h1>Edit Coin Transaction</h1>

    <form action="{{ route('coin-transactions.update', $transaction) }}" method="POST">
    @csrf
    @method('PUT')

        <div class="mb-3">
            <label class="form-label">User</label>
            <select name="user_id" class="form-control" required>
                <option value="">Select User</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Service</label>
            <select name="service_id" class="form-control" required>
                <option value="">Select Service</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Salon</label>
            <select name="salon_id" class="form-control" required>
                <option value="">Select Salon</option>
                @foreach($salons as $salon)
                    <option value="{{ $salon->id }}">{{ $salon->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Coins (e.g., +10 or -5)</label>
            <input type="number" name="coins" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Type</label>
            <select name="type" class="form-control" required>
                <option value="earn">Earn</option>
                <option value="redeem">Redeem</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="pending">Pending</option>
                <option value="confirmed">Confirmed</option>
                <option value="rejected">Rejected</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Save Transaction</button>
        <a href="{{ route('coin-transactions.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection