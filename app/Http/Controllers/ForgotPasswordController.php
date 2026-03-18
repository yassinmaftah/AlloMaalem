<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function showEmailForm()
    {
        return view('auth.forgot-password');
    }

    public function sendCode(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $code = rand(100000, 999999);

        DB::table('password_reset_codes')->where('email', $request->email)->delete();

        DB::table('password_reset_codes')->insert([
            'email' => $request->email,
            'code'  => $code,
        ]);

        Mail::raw("Your password reset code is: $code", function ($message) use ($request) {
            $message->to($request->email)->subject('Password Reset Code');
        });

        return redirect()->route('password.code.form', ['email' => $request->email]);
    }

    public function showCodeForm(Request $request)
    {
        return view('auth.verify-code', ['email' => $request->email]);
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code'  => 'required|digits:6',
        ]);

        $record = DB::table('password_reset_codes')
            ->where('email', $request->email)
            ->where('code', $request->code)
            ->first();

        if (!$record) {
            return back()->withErrors(['code' => 'The code is incorrect.'])->withInput();
        }

        return redirect()->route('password.reset.form', [
            'email' => $request->email,
            'code'  => $request->code,
        ]);
    }

    public function showResetForm(Request $request)
    {
        return view('auth.reset-password', [
            'email' => $request->email,
            'code'  => $request->code,
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email'    => 'required|email|exists:users,email',
            'code'     => 'required|digits:6',
            'password' => 'required|min:8|confirmed',
        ]);

        $record = DB::table('password_reset_codes')
            ->where('email', $request->email)
            ->where('code', $request->code)
            ->first();

        if (!$record)
            return back()->withErrors(['code' => 'Invalid or expired code.']);

        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password),
        ]);

        DB::table('password_reset_codes')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', 'Password updated successfully!');
    }
}
