<?php

namespace App\Http\Controllers\SalonOwner;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Salon;
use Illuminate\Http\Request;

class OfferController extends Controller
{
  public function create(Salon $salon)
{
    if ($salon->user_id != auth()->id()) {
        abort(403, 'You do not own this salon.');
    }

    // جلب جميع الخدمات المرتبطة بهذا الصالون
    $services = \App\Models\Service::where('salon_id', $salon->id)->get();

    return view('salon-owner.offer-create', compact('salon', 'services'));
}   

    public function store(Request $request, Salon $salon)
    {
        if ($salon->user_id != auth()->id()) {
            abort(403, 'You do not own this salon.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'required_coins' => 'required|integer|min:0',
            'discount_percentage' => 'required|integer|min:0|max:100',
        ]);

        $offer = Offer::create([
            'salon_id' => $salon->id,
            'name' => $request->name,
            'required_coins' => $request->required_coins,
            'discount_percentage' => $request->discount_percentage,
            'is_active' => true,
        ]);

        return redirect()->route('salon.owner.dashboard')->with('success', 'Offer created successfully!');
    }
}