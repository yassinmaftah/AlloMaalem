<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;

class MaalemJobController extends Controller
{
    public function index(Request $request)
    {
        $query = Job::where('status', 'open');

        if ($request->city_id)
            $query->where('city_id', $request->city_id);
        if ($request->category_id)
            $query->where('category_id', $request->category_id);

        $jobs = $query->with('category', 'city', 'user')->paginate(9);
        $categories = \App\Models\Category::all();
        $cities = \App\Models\City::all();

        return view('maalem.jobs.index', compact('jobs', 'categories', 'cities'));
    }

    public function show($id)
    {
        $job = Job::where('id', $id)
            ->where('status', 'open')
            ->with('category', 'city', 'user')
            ->firstOrFail();

        $alreadyApplied = Application::where('job_id', $id)
            ->where('user_id', auth()->id())
            ->exists();

        return view('maalem.jobs.show', compact('job', 'alreadyApplied'));
    }

    public function store(Request $request, $id)
    {
        $job = Job::where('id', $id)->where('status', 'open')->firstOrFail();

        $alreadyApplied = Application::where('job_id', $id)
            ->where('user_id', auth()->id())
            ->exists();

        if ($alreadyApplied)
            return redirect()->route('maalem.jobs.show', $id)->with('error', 'You have already applied to this job.');

        $request->validate([
            'proposed_price' => 'required|numeric|min:0',
            'message'        => 'required|string|max:1000',
        ]);

        Application::create([
            'job_id'         => $job->id,
            'user_id'        => auth()->id(),
            'proposed_price' => $request->proposed_price,
            'message'        => $request->message,
            'status'         => 'pending',
        ]);

        return redirect()->route('maalem.jobs.show', $id)->with('success', 'Application submitted successfully!');
    }
}
