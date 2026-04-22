<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Job;
use App\Models\Application;
use App\Models\User;
use App\Models\Review;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\SystemNotificationMail;


class ClientJobController extends Controller
{
    public function index(Request $request)
    {
        // dd($request);
        $tab = $request->get('tab', 'all');

        $query = Job::where('user_id', auth()->id())->with('applications');

        if ($tab !== 'all')
            $query->where('status', $tab);

        $jobs = $query->latest('created_at')->paginate(9)->withQueryString();

        $counts = [
            'all'         => Job::where('user_id', auth()->id())->count(),
            'open'        => Job::where('user_id', auth()->id())->where('status', 'open')->count(),
            'in_progress' => Job::where('user_id', auth()->id())->where('status', 'in_progress')->count(),
            'completed'   => Job::where('user_id', auth()->id())->where('status', 'completed')->count(),
        ];

        return view('client.jobs.index', compact('jobs', 'counts', 'tab'));
    }

    public function create()
    {
        $categories = Category::all();
        $cities = City::all();
        return view('client.jobs.create', compact('categories', 'cities'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        if ($user->verification_status !== 'verified') {

            $openJobs = Job::where('user_id', $user->id)
                ->where('status', 'open')
                ->count();

            if ($openJobs >= 3)
                return redirect()->back()->with('error', 'Normal accounts can only have 3 open jobs at a time. Request Premium!');

            $monthJobs = Job::where('user_id', $user->id)
                ->whereMonth('created_at', date('m'))
                ->whereYear('created_at', date('Y'))
                ->count();

            if ($monthJobs >= 3)
                return redirect()->back()->with('error', 'Normal accounts can only post 3 jobs per month. Request Premium!');
        }

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'budget'      => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'city_id'     => 'required|exists:cities,id',
            'image'       => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image'))
            $imagePath = $request->file('image')->store('jobs', 'public');

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

        // $ids_of_users_already_Apply = Application::where('job_id', $job->id)->pluck('user_id')->toArray();
        // // dd($ids_of_users_already_Apply);
        // $i = 0;
        // while($i < count($ids_of_users_already_Apply) )
        // {
        //     $user = User::find($ids_of_users_already_Apply[$i]);
        //     $message = "A job you applied for has been updated";
        //     // echo $user->email;
        //     Mail::to($user->email)->send(new SystemNotificationMail($message));
        //     $i++;
        // }

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

    public function accept(Request $request, $id)
    {
        $offer = Application::find($id);
        if (!$offer)
            return redirect()->back()->with('error', 'This offer was not found or has been deleted.');


        $job = Job::find($offer->job_id);

        if ($job->user_id !== auth()->id())
            return redirect()->back()->with('error', 'This job is not for you');

        if ($job->status !== 'open')
            return redirect()->back()->with('error', 'You have already assigned this job to someone else!');

        if ($request->expected_price != $offer->proposed_price)
        {
            return redirect()->back()->with('error',
                'Wait! The Maalem just updated their price to ' . $offer->proposed_price . ' MAD. Please review the new offer before accepting.'
            );
        }


        $offer->status = 'accepted';
        $offer->save();

        $job->status = 'in_progress';
        $job->save();

        Application::where('job_id', $job->id)
            ->where('id', '!=', $offer->id)
            ->update(['status' => 'rejected']);


        $maalem = $offer->user;
        $message = "Your application for the job '" . $job->title . "' has been " . $job->status . " by the client.";
        Mail::to($maalem->email)->send(new SystemNotificationMail($message));

        return redirect()->back()->with('success', 'Offer accepted');
    }

    public function reject($id)
    {
        $offer = Application::find($id);
        $job = Job::find($offer->job_id);

        if ($job->user_id !== auth()->id())
            return redirect()->back();

        $offer->status = 'rejected';
        $offer->save();

        return redirect()->back()->with('success', 'Offer rejected');
    }

    public function complete($id)
    {
        $job = Job::find($id);

        if ($job->user_id !== auth()->id())
            return redirect()->back();

        $job->status = 'completed';
        $job->save();

        return redirect()->back()->with('success', 'Job marked as completed');
    }

    public function review(Request $request, $id)
    {
        $job = Job::find($id);

        if ($job->user_id !== auth()->id())
            return redirect()->back();

        $offer = Application::where('job_id', $job->id)->where('status', 'accepted')->first();

        $review = new Review();
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->job_id = $job->id;
        $review->reviewer_id = auth()->id();
        $review->reviewed_id = $offer->user_id;
        $review->save();

        return redirect()->back()->with('success', 'Review added');
    }
}
