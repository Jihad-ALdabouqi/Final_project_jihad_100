<?php

namespace App\Http\Controllers\Admin;

use App\Models\Feedback;
use App\Models\User;
use App\Models\Salon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FeedbackController extends Controller
{
    public function index(): View
    {
        $feedbacks = Feedback::with(['user', 'salon'])->latest()->paginate(15);
        return view('admin.feedbacks', compact('feedbacks'));
    }

    public function create(): View
    {
        $users = User::all();
        $salons = Salon::all();
        return view('admin.feedbacks-create', compact('users', 'salons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'salon_id' => 'required|exists:salons,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        Feedback::create($request->all());

        return redirect()->route('feedbacks.index')
            ->with('success', 'Feedback created successfully.');
    }

    public function edit(Feedback $feedback): View
    {
        $users = User::all();
        $salons = Salon::all();
        return view('feedbacks-edit', compact('feedback', 'users', 'salons'));
    }

    public function update(Request $request, Feedback $feedback)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'salon_id' => 'required|exists:salons,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $feedback->update($request->all());

        return redirect()->route('feedbacks.index')
            ->with('success', 'Feedback updated successfully.');
    }

    public function destroy(Feedback $feedback)
    {
        $feedback->delete();
        return redirect()->route('feedbacks.index')
            ->with('success', 'Feedback deleted successfully.');
    }
}