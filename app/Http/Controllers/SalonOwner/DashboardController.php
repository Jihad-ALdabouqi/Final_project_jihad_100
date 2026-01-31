<?php

namespace App\Http\Controllers\SalonOwner;

use App\Http\Controllers\Controller;
use App\Models\Salon;
use App\Models\Service;
use App\Models\CoinTransaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
 public function index()
{
    
    $notifications = Auth::user()->unreadNotifications()->latest()->take(5)->get();

    
    $salon = Salon::where('user_id', Auth::id())->first();

    
    if (!$salon) {
        
        $services = collect();
        $requests = collect();
        return view('salon-owner.dashboard', compact('salon', 'services', 'requests', 'notifications'));
    }

   
    $services = Service::where('salon_id', $salon->id)->get();
    $requests = CoinTransaction::where('salon_id', $salon->id)
        ->where('type', 'earn')
        ->where('status', 'pending')
        ->with('user')
        ->get();

    return view('salon-owner.dashboard', compact('salon', 'services', 'requests', 'notifications'));
}
}