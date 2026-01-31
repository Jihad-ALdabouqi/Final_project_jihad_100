<?php

namespace App\Http\Controllers\SalonOwner;

use App\Http\Controllers\Controller;
use App\Models\CoinTransaction;
use Illuminate\Http\Request;

class CoinRequestController extends Controller
{
    public function approve(CoinTransaction $request)
{
    // التحقق من الملكية
    if ($request->salon->user_id !== auth()->id()) { // ← غيرنا من owner_id إلى user_id
    abort(403, 'You do not own this salon.');
}

    // التأكد أنه طلب كسب وليس خصم
    if ($request->type !== 'earn' || $request->status !== 'pending') {
        return back()->with('error', 'Invalid request.');
    }

    // ✅ هنا كان الخطأ: استخدمت 'approved' بدل 'confirmed'
    $request->update(['status' => 'confirmed']); // ← غيرها لـ 'confirmed'

    // إضافة العملات للمستخدم
    $request->user->increment('coins', $request->coins);

    return back()->with('success', 'Coins added to user successfully.');
}

    public function reject(CoinTransaction $request)
    {
        // التحقق من أن الطلب مرتبط بصالون المستخدم الحالي
        if ($request->salon_id != auth()->user()->salons()->first()->id) {
            abort(403);
        }

        $request->update(['status' => 'rejected']);

        return back()->with('success', 'Request rejected.');
    }
}