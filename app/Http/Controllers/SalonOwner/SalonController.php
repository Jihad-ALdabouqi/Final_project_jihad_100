<?php

namespace App\Http\Controllers\SalonOwner;

use App\Http\Controllers\Controller;
use App\Models\Salon;
use Illuminate\Http\Request;

class SalonController extends Controller
{
    public function edit(Salon $salon)
    {
      
        if ($salon->user_id != auth()->id()) {
            abort(403, 'You do not own this salon.');
        }

       return view('salon-owner.salon-edit', compact('salon'));
    }

    public function create()
    {
        $existingSalon = Salon::where('user_id', auth()->id())->first();

        if ($existingSalon) {
            return redirect()->route('salon.owner.dashboard')->with('info', 'You already have a salon. You can edit it from here.');
        }

        return view('salon-owner.create-salon');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'description' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['name', 'location', 'phone', 'email', 'description', 'image_path']);

        if ($request->hasFile('image_path')) {
            $path = $request->file('image_path')->store('salons', 'public');
            $data['image_path'] = 'storage/' . $path;
        } else {
            $data['image_path'] = 'img/default-salon.jpg';
        }

        $data['user_id'] = auth()->id();
        $data['is_approved'] = true;

        Salon::create($data);

        return redirect()->route('salon.owner.dashboard')->with('success', 'The salon has been created successfully.');
    }

   public function update(Request $request, Salon $salon)
{
    if ($salon->user_id != auth()->id()) {
        abort(403, 'You do not own this salon.');
    }

    $request->validate([
        'name' => 'required|string|max:255',
        'location' => 'required|string',
        'phone' => 'nullable|string|max:20',
        'email' => 'nullable|email|max:255',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $data = $request->only(['name', 'location', 'phone', 'email', 'description']);

    if ($request->hasFile('image')) {
       
        if ($salon->image_path && $salon->image_path !== 'img/default-salon.jpg') {
            \Storage::disk('public')->delete(str_replace('storage/', '', $salon->image_path));
        }

        $path = $request->file('image')->store('salons', 'public');
        $data['image_path'] = 'storage/' . $path; 
    }

    $salon->update($data);

    return redirect()->route('salon.owner.dashboard')->with('success', 'The salon has been updated successfully.');
}
}