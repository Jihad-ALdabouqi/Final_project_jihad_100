<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Salon;

class SalonController extends Controller
{
   public function show($id)
{
    $salon = Salon::with(['services' => function ($query) {
        $query->where('is_active', true);
    }])->findOrFail($id);

   
    $offers = \App\Models\Offer::where('salon_id', $salon->id)->where('is_active', true)->get();

    return view('user.pages.salon-show', compact('salon', 'offers'));
}

    
}