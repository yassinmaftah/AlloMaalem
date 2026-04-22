<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister(){return view('auth.register');}

    public function register(Request $request)
    {
        $Data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'phone' => 'required|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'role' => 'required|in:client,maalem',
        ]);

        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        $user = User::create([
            'name' => $Data['name'],
            'email' => $Data['email'],
            'password' => Hash::make($Data['password']),
            'phone' => $Data['phone'],
            'avatar' => $avatarPath,
            'role' => $Data['role'],
        ]);

        Auth::login($user);
        return redirect()->route('dashboard');
    }

    public function showLogin(){return view('auth.login');}

    public function login(Request $request)
    {
        $Data = $request->validate
        (
            ['email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($Data, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'Password or email are incorrect.',
        ])->onlyInput('email');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
