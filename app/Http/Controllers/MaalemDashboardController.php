<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use App\Models\Review;
use Illuminate\Http\Request;

class MaalemDashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $pendingApplications = Application::where('user_id', $userId)
            ->where('status', 'pending')
            ->count();

        $activeJobs = Job::where('status', 'in_progress')
            ->whereHas('applications', function ($query) use ($userId) {
                $query->where('user_id', $userId)->where('status', 'accepted');
            })
            ->count();

        $averageRating = Review::where('reviewed_id', $userId)->avg('rating');

        return view('maalem.dashboard', compact('pendingApplications', 'activeJobs', 'averageRating'));
    }
}
