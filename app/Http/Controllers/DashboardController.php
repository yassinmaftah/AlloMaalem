<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin')
            return redirect()->route('admin.dashboard');

        if ($user->role === 'client')
            return redirect()->route('client.dashboard');

        if ($user->role === 'maalem')
            return redirect()->route('maalem.dashboard');

        return abort(403);
    }
}
