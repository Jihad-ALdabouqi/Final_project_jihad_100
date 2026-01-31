<?php

namespace App\Http\Controllers\SalonOwner;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Salon;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function create(Salon $salon)
    {
        if ($salon->user_id != auth()->id()) {
            abort(403, 'You do not own this salon.');
        }

        return view('salon-owner.service-create', compact('salon'));
    }

    public function store(Request $request, Salon $salon)
    {
        if ($salon->user_id != auth()->id()) {
            abort(403, 'You do not own this salon.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'coin_cost' => 'nullable|integer|min:0',
            'discount' => 'nullable|integer|min:0',
            'coins_earned' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['name', 'price', 'coin_cost', 'coins_earned', 'description', 'discount']);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('services', 'public');
            $data['image'] = $path;
        }

        $data['salon_id'] = $salon->id;

        Service::create($data);

        return redirect()->route('salon.owner.dashboard')->with('success', 'تم إنشاء الخدمة بنجاح.');
    }

    public function edit(Salon $salon, Service $service)
    {
        if ($salon->user_id != auth()->id()) {
            abort(403, 'You do not own this salon.');
        }

        return view('salon-owner.service-edit', compact('salon', 'service'));
    }

    public function update(Request $request, Salon $salon, Service $service)
    {
        if ($salon->user_id != auth()->id()) {
            abort(403, 'You do not own this salon.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'coin_cost' => 'nullable|integer|min:0',
            'discount' => 'nullable|integer|min:0',
            'coins_earned' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['name', 'price', 'coin_cost', 'coins_earned', 'description', 'discount']);

        if ($request->hasFile('image')) {
            if ($service->image && !str_starts_with($service->image, 'img/default')) {
                \Storage::disk('public')->delete($service->image);
            }

            $path = $request->file('image')->store('services', 'public');
            $data['image'] = $path;
        }

        $service->update($data);

        return redirect()->route('salon.owner.dashboard')->with('success', 'تم تحديث الخدمة بنجاح.');
    }

    public function destroy(Salon $salon, Service $service)
    {
        if ($salon->user_id != auth()->id()) {
            abort(403, 'You do not own this salon.');
        }

        $service->delete();

        return redirect()->route('salon.owner.dashboard')->with('success', 'تم حذف الخدمة بنجاح.');
    }
}