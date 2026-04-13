<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Job;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_clients' => User::where('role', 'client')->count(),
            'total_maalems' => User::where('role', 'maalem')->count(),
            'total_admins' => User::where('role', 'admin')->count(),
            'premium_users' => User::where('verification_status', 'verified')->count(),
            'open_jobs'     => Job::where('status', 'open')->count(),
        ];

        $recentUsers = User::orderBy('created_at', 'desc')->get();
        $recentJobs = Job::with('user')->orderBy('created_at', 'desc')->get();

        return view('admin.dashboard', compact('stats', 'recentUsers', 'recentJobs'));
    }
}
