<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalJobs = Job::where('user_id', $user->id)->count();

        $activeJobs = Job::where('user_id', $user->id)
            ->whereIn('status', ['open', 'in_progress'])
            ->count();

        $completedJobs = Job::where('user_id', $user->id)
            ->where('status', 'completed')
            ->count();

        $ongoingJobs = Job::where('user_id', $user->id)
            ->whereIn('status', ['open', 'in_progress'])
            ->latest()
            ->take(3)
            ->get();


        return view('client.dashboard', compact(
            'totalJobs',
            'activeJobs',
            'completedJobs',
            'ongoingJobs'

        ));
    }
}
