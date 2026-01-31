<?php

namespace App\Http\Controllers\Admin;

use App\Models\Offer;
use App\Models\Salon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OfferController extends Controller
{
    public function index(): View
    {
        $offers = Offer::with('salon')->latest()->paginate(15);
        return view('admin.offers', compact('offers'));
    }

    public function create(): View
    {
        $salons = Salon::all();
        return view('admin.offers-create', compact('salons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'salon_id' => 'required|exists:salons,id',
            'required_coins' => 'required|integer|min:1',
            'discount_percentage' => 'required|integer|min=0|max=100',
            'is_active' => 'nullable|boolean',
        ]);

        Offer::create([
            'name' => $request->name,
            'salon_id' => $request->salon_id,
            'required_coins' => $request->required_coins,
            'discount_percentage' => $request->discount_percentage,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('offers.index')
            ->with('success', 'Offer created successfully.');
    }

    public function edit(Offer $offer): View
    {
        $salons = Salon::all();
        return view('offers-edit', compact('offer', 'salons'));
    }

    public function update(Request $request, Offer $offer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'salon_id' => 'required|exists:salons,id',
            'required_coins' => 'required|integer|min=1',
            'discount_percentage' => 'required|integer|min=0|max=100',
            'is_active' => 'nullable|boolean',
        ]);

        $offer->update([
            'name' => $request->name,
            'salon_id' => $request->salon_id,
            'required_coins' => $request->required_coins,
            'discount_percentage' => $request->discount_percentage,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('offers.index')
            ->with('success', 'Offer updated successfully.');
    }

    public function destroy(Offer $offer)
    {
        $offer->delete();
        return redirect()->route('offers.index')
            ->with('success', 'Offer deleted successfully.');
    }
}