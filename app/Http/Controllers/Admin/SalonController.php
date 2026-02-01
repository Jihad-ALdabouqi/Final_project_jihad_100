<?php

namespace App\Http\Controllers\Admin;

use App\Models\Salon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalonController extends Controller
{
    public function index()
    {
        $salons = Salon::latest()->paginate(10);
        return view('admin.salons', compact('salons'));
    }

    public function create()
    {
        return view('admin.salons-create');
    }

    public function store(Request $request)
    {
//         dd([
//     'is_authenticated' => auth()->check(),
//     'current_user_id' => auth()->id(),
//     'current_user_role' => auth()->user()?->role,
//     'request_data' => $request->all(),
// ]);
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'description' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['name', 'location', 'phone', 'email', 'description']);

        if ($request->hasFile('image_path')) {
            $path = $request->file('image_path')->store('salons', 'public');
            $data['image_path'] = 'storage/' . $path;
        } else {
            $data['image_path'] = 'img/default-salon.jpg';
        }

        $data['user_id'] = auth()->id();

        Salon::create($data);

        return redirect()->route('salons.index')->with('success', "Salon created successfully.");
    }

    public function update(Request $request, Salon $salon)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'description' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['name', 'location', 'phone', 'email', 'description']);

        if ($request->hasFile('image_path')) {
            if ($salon->image_path && !str_starts_with($salon->image_path, 'img/default')) {
                \Storage::disk('public')->delete(str_replace('storage/', '', $salon->image_path));
            }

            $path = $request->file('image_path')->store('salons', 'public');
            $data['image_path'] = 'storage/' . $path;
        }

        $data['user_id'] = auth()->id();

        $salon->update($data);

        return redirect()->route('salons.index')->with('success', "Salon updated successfully.");
    }

    public function destroy(Salon $salon)
    {
        $salon->delete();
        return redirect()->route('salons.index')->with('success', "Salon deleted successfully.");
    }

    public function edit(Salon $salon)
    {
        return view('admin.salons-edit', compact('salon'));
    }
}