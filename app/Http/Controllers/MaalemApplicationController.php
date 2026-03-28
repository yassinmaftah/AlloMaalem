<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;

class MaalemApplicationController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'pending');
        $userId = auth()->id();

        if ($tab === 'accepted')
        {
            $apps = Application::where('user_id', $userId)
                ->where('status', 'accepted')
                ->whereHas('job', function($q) {
                    $q->where('status', 'in_progress');
                })
                ->with('job.user')
                ->get();
        }
        elseif ($tab === 'rejected')
        {
            $apps = Application::where('user_id', $userId)
                ->where('status', 'rejected')
                ->with('job')
                ->get();
        }
        elseif ($tab === 'completed')
        {
            $apps = Application::where('user_id', $userId)
                ->where('status', 'accepted')
                ->whereHas('job', function($q) {
                    $q->where('status', 'completed');
                })
                ->with('job.review')
                ->get();
        }
        else
        {
            $apps = Application::where('user_id', $userId)
                ->where('status', 'pending')
                ->with('job')
                ->get();
        }

        return view('maalem.applications.index', compact('apps', 'tab'));
    }

    public function edit($id)
    {
        $application = Application::with('job')->findOrFail($id);
        if ($application->user_id !== auth()->id())
            return redirect()->back();
        return view('maalem.applications.edit', compact('application'));
    }

    public function update(Request $request, $id)
    {
        $app = Application::findOrFail($id);
        if ($app->user_id !== auth()->id()) return redirect()->back();

        $app->proposed_price = $request->proposed_price;
        $app->message = $request->message;
        $app->save();

        return redirect()->route('maalem.applications.index');
    }

    public function destroy($id)
    {
        $app = Application::findOrFail($id);
        if ($app->user_id !== auth()->id())
            return redirect()->back();

        $app->delete();
        return redirect()->back();
    }

    public function reapply(Request $request, $id)
    {
        $app = Application::find($id);
        $job = Job::find($app->job_id);

        if ($app->user_id !== auth()->id() || $job->status !== 'open')
            return redirect()->back();

        $app->proposed_price = $request->price;
        $app->status = 'pending';
        $app->save();

        return redirect()->back();
    }
}
