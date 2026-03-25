<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Job;
use Illuminate\Http\Request;

class ClientJobController extends Controller
{
    public function index()
    {
        $jobs = Job::where('user_id', auth()->id())->latest('created_at')->get();
        return view('client.jobs.index', compact('jobs'));
    }

    public function create()
    {
        $categories = Category::all();
        $cities = City::all();
        return view('client.jobs.create', compact('categories', 'cities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'budget'      => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'city_id'     => 'required|exists:cities,id',
            'image'       => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('jobs', 'public');
        }

        Job::create([
            'title'       => $request->title,
            'description' => $request->description,
            'budget'      => $request->budget,
            'category_id' => $request->category_id,
            'city_id'     => $request->city_id,
            'is_urgent'   => $request->has('is_urgent'),
            'image'       => $imagePath,
            'status'      => 'open',
            'user_id'     => auth()->id(),
        ]);

        return redirect()->route('client.jobs.index')->with('success', 'Job posted successfully!');
    }

    public function edit($id)
    {
        $job = Job::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        if ($job->status !== 'open')
            return redirect()->route('client.jobs.show', $job->id)->with('error', 'You can only edit open jobs.');

        $categories = Category::all();
        $cities = City::all();
        return view('client.jobs.edit', compact('job', 'categories', 'cities'));
    }

    public function update(Request $request, $id)
    {
        $job = Job::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        if ($job->status !== 'open')
            return redirect()->route('client.jobs.show', $job->id)->with('error', 'You can only edit open jobs.');

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'budget'      => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'city_id'     => 'required|exists:cities,id',
            'image'       => 'nullable|image|max:2048',
        ]);

        $imagePath = $job->image;
        if ($request->hasFile('image'))
            $imagePath = $request->file('image')->store('jobs', 'public');

        $job->update([
            'title'       => $request->title,
            'description' => $request->description,
            'budget'      => $request->budget,
            'category_id' => $request->category_id,
            'city_id'     => $request->city_id,
            'is_urgent'   => $request->has('is_urgent'),
            'image'       => $imagePath,
        ]);

        return redirect()->route('client.jobs.show', $job->id)->with('success', 'Job updated successfully!');
    }

    public function destroy($id)
    {
        $job = Job::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        if ($job->status !== 'open') {
            return redirect()->route('client.jobs.show', $job->id)->with('error', 'You can only delete open jobs.');
        }

        $job->applications()->where('status', 'pending')->delete();
        $job->delete();

        return redirect()->route('client.jobs.index')->with('success', 'Job deleted successfully!');
    }

    public function show($id)
    {
        $job = Job::where('id', $id)
                    ->where('user_id', auth()->id())
                    ->with('applications.user.reviewsReceived')
                    ->firstOrFail();
        return view('client.jobs.show', compact('job'));
    }
}
