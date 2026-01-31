<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\CoinTransaction;
use Illuminate\Support\Facades\Auth;
use App\Notifications\CoinRedeemedNotification;

class CoinController extends Controller
{
    public function redeemCoins(Request $request, Service $service)
    {
        $user = Auth::user();
        $salon = $service->salon;

        // التحقق من الرصيد
        if ($user->coins < $service->coin_cost) {
            return back()->with('error', 'You do not have enough coins to redeem this service.');
        }

        // خصم العملات
        $user->decrement('coins', $service->coin_cost);

        // تسجيل العملية في جدول coin_transactions
        CoinTransaction::create([
            'user_id' => $user->id,
            'service_id' => $service->id,
            'salon_id' => $salon->id,
            'coins' => -$service->coin_cost, // سالب لأنها خصم
            'type' => 'redeem',
            'status' => 'confirmed',
        ]);

        // إرسال إشعار للـ SalonOwner
        $salonOwner = $salon->owner; // افترض أن عندك علاقة owner في Salon
        $salonOwner->notify(new CoinRedeemedNotification($user, $service));

        // رسالة للمستخدم
        return back()->with('success', '🎉 Discount applied successfully! You paid ' . ($service->price - ($service->price * $service->discount / 100)) . ' JOD using ' . $service->coin_cost . ' coins.');
    }
}