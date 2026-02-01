<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\CoinTransaction;
use Illuminate\Support\Facades\Auth;
use App\Notifications\CoinRedeemedNotification;
use App\Notifications\CoinRequestedNotification;

class CoinRequestController extends Controller
{
   
    public function redeemCoins(Request $request, Service $service)
    {
        $user = Auth::user();
        $salon = $service->salon;

        if ($user->coins < $service->coin_cost) {
            return back()->with('error', 'You do not have enough coins to redeem this service.');
        }

        // خصم العملات
        $user->decrement('coins', $service->coin_cost);

        // تسجيل العملية
        CoinTransaction::create([
            'user_id' => $user->id,
            'service_id' => $service->id,
            'salon_id' => $salon->id,
            'coins' => -$service->coin_cost,
            'type' => 'redeem',
            'status' => 'confirmed',
        ]);

        // إرسال إشعار للـ SalonOwner
        $salonOwner = $salon->owner;
        $salonOwner->notify(new CoinRedeemedNotification($user, $service));

        return back()->with('success', '🎉 Discount applied successfully! You paid ' . ($service->price - $service->coin_cost) . ' JOD using ' . $service->coin_cost . ' coins.');
    }

    // زر "Request Coins (No Immediate Deduction)"
    public function requestCoins(Request $request, Service $service)
    {
        $user = Auth::user();
        $salon = $service->salon;

        if ($service->coins_earned <= 0) {
            return back()->with('error', 'This service does not offer coins.');
        }

        // إنشاء طلب معلق
        CoinTransaction::create([
            'user_id' => $user->id,
            'service_id' => $service->id,
            'salon_id' => $salon->id,
            'coins' => $service->coins_earned,
            'type' => 'earn',
            'status' => 'pending',
        ]);

        // إرسال إشعار للـ SalonOwner
        $salonOwner = $salon->owner;
        $salonOwner->notify(new CoinRequestedNotification($user, $service));

        return back()->with('info', 'Your coin request has been sent. Wait for approval after your service.');
    }
}