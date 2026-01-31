<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\CoinTransaction;
use App\Models\User;
use App\Models\Service;
use App\Models\Salon;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class CoinTransactionController extends Controller
{
    public function index(): View
    {
        $transactions = CoinTransaction::with(['user', 'service', 'salon'])
            ->latest()
            ->paginate(15);

        return view('admin.coin-transactions', compact('transactions'));
    }

    public function create(): View
    {
        $users = User::all();
        $services = Service::all();
        $salons = Salon::all();

        return view('admin.coin-transactions-create', compact('users', 'services', 'salons'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'salon_id' => 'required|exists:salons,id',
            'coins' => 'required|integer',
            'type' => 'required|in:earn,redeem',
            'status' => 'required|in:pending,confirmed,rejected',
        ]);

        CoinTransaction::create($request->all());

        return redirect()->route('coin-transactions.index')
            ->with('success', 'Transaction created successfully.');
    }

    public function edit(CoinTransaction $transaction): View
    {
        $users = User::all();
        $services = Service::all();
        $salons = Salon::all();

        return view('coin-transactions-edit', compact('transaction', 'users', 'services', 'salons'));
    }

    public function update(Request $request, CoinTransaction $transaction): RedirectResponse
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'salon_id' => 'required|exists:salons,id',
            'coins' => 'required|integer',
            'type' => 'required|in:earn,redeem',
            'status' => 'required|in:pending,confirmed,rejected',
        ]);

        $transaction->update($request->all());

        return redirect()->route('coin-transactions.index')
            ->with('success', 'Transaction updated successfully.');
    }

    public function destroy(CoinTransaction $transaction): RedirectResponse
    {
        $transaction->delete();

        return redirect()->route('coin-transactions.index')
            ->with('success', 'Transaction deleted successfully.');
    }
}