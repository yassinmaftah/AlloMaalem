<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function edit($id)
    {
        $application = Application::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('maalem.applications.edit', compact('application'));
    }

    public function update(Request $request, $id)
    {
        $application = Application::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if ($application->status !== 'pending') {
            return redirect()->route('maalem.applications.index')->with('error', 'You can only edit pending applications.');
        }

        $request->validate([
            'proposed_price' => 'required|numeric|min:0',
            'message'        => 'required|string|max:1000',
        ]);

        $application->update([
            'proposed_price' => $request->proposed_price,
            'message'        => $request->message,
        ]);

        return redirect()->route('maalem.applications.index')->with('success', 'Application updated successfully!');
    }

    public function destroy($id)
    {
        $application = Application::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if ($application->status !== 'pending')
            return redirect()->route('maalem.applications.index')->with('error', 'You can only cancel pending applications.');

        $application->delete();

        return redirect()->route('maalem.applications.index')->with('success', 'Application cancelled successfully!');
    }
}
