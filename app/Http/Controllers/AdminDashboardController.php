<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Job;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalClients = User::where('role', 'client')->count();
        $totalMaalems = User::where('role', 'maalem')->count();
        $premiumUsers = User::where('verification_status', 'verified')->count();

        $openJobs = Job::where('status', 'open')->count();
        $completedJobs = Job::where('status', 'completed')->count();

        return view('admin.dashboard', compact(
            'totalClients', 'totalMaalems', 'premiumUsers', 'openJobs', 'completedJobs'
        ));
    }
}
