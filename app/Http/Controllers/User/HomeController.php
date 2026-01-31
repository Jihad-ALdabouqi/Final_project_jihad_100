<?php

namespace App\Http\Controllers\User;

use App\Models\Salon;
use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $salons = Salon::all();
       $offer = Offer::where('is_active', true)->first(); // Get one active offer (for hero/pricing)

        return view('user.pages.home', compact('salons', 'offer'));
    }
}