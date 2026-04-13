<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Job;

class AdminUserController extends Controller
{
    public function pendingRequests()
    {
        $users = User::where('verification_status', 'pending')->get();

        return view('admin.requests.index', compact('users'));
    }

    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->verification_status = 'verified';
        $user->save();

        return redirect()->back()->with('success', $user->name . ' is now a Premium user!');
    }

    public function reject($id)
    {
        $user = User::findOrFail($id);
        $user->verification_status = 'unverified';
        $user->save();

        return redirect()->back()->with('success', $user->name . ' request was rejected.');
    }

    public function index(Request $request)
    {
        $query = User::where('role', '!=', 'admin');

        if ($request->search)
            $query->where('name', 'LIKE', '%' . $request->search . '%');

        $users = $query->get();

        return view('admin.users.index', compact('users'));
    }

    public function ban($id)
    {
        $user = User::findOrFail($id);
        $user->is_baned = 1;
        $user->save();


        if ($user->role === 'maalem') {
            Application::where('user_id', $user->id)
                ->where('status', 'pending')
                ->delete();
        }
        elseif ($user->role === 'client') {
            Job::where('user_id', $user->id)
                ->where('status', 'open')
                ->delete();
        }

        return redirect()->back()->with('success', $user->name . ' has been banned and their active data was cleaned up.');
    }

    public function unban($id)
    {
        $user = User::findOrFail($id);
        $user->is_baned = 0;
        $user->save();

        return redirect()->back()->with('success', $user->name . ' has been unbanned.');
    }
}
