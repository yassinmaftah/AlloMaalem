<?php

namespace App\Http\Controllers;

use App\Models\Application;

class MaalemApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::where('user_id', auth()->id())
            ->with('job')
            ->latest('created_at')
            ->paginate(10);

        return view('maalem.applications.index', compact('applications'));
    }
}
