<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Models\Salon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('salon')->latest()->paginate(10);
        return view('admin.services', compact('services'));
    }

    public function create()
    {
        $salons = Salon::all();
        return view('admin.services-create', compact('salons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'salon_id' => 'required|exists:salons,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'coin_cost' => 'required|integer|min:0',
            'coins_earned' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
    $image = 'storage/' . $request->file('image')->store('services', 'public');
} else {
    $image = null;
}

        Service::create(array_merge(
            $request->except('image'),
            ['image' => $image]
        ));

        return redirect()->route('services.index')->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        $salons = Salon::all();
        return view('services-edit', compact('service', 'salons'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'salon_id' => 'required|exists:salons,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'coin_cost' => 'required|integer|min:0',
            'coins_earned' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

       if ($request->hasFile('image')) {
    $image = 'storage/' . $request->file('image')->store('services', 'public');
} else {
    $image = null;
}

        $service->update($request->except('image'));

        return redirect()->route('services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
    }
}