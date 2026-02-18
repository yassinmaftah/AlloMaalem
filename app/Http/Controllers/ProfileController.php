<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function create()
    {
        $user = Auth::user();

        if ($user->info_done)
            return redirect()->route('dashboard');
        if ($user->role === 'client')
            return view('client.complete-profile');
        elseif ($user->role === 'maalem')
            return view('maalem.complete-profile');

        return abort(403);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $user = Auth::user();

        if ($user->role === 'client')
        {
            $validated = $request->validate([
                'phone'  => 'required|string|max:20',
                'city'   => 'required|string|max:50',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
            ]);
        } else
        {
            $validated = $request->validate([
                'phone'      => 'required|string|max:20',
                'city'       => 'required|string|max:50',
                'avatar'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'bio'        => 'required|string|max:500',
                'speciality' => 'required|string|max:100',
            ]);
        }

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = $path;
        }
        $validated['info_done'] = true;

        /** @var \App\Models\User $user */
        $user->update($validated);

        return redirect()->route('dashboard');
    }
}
