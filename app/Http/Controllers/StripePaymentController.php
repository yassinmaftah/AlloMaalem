<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Auth;

use App\Models\Payment;

class StripePaymentController extends Controller
{
    public function checkout()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $userRole = Auth::user()->role;

        if ($userRole == "client")
            $amount = 2999;
        else
            $amount = 1999;

        $session = Session::create([
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Premium Account Verification',
                        'description' => 'One-time fee to verify your account and unlock premium features.',
                    ],
                    'unit_amount' => $amount,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('stripe.cancel'),
        ]);

        return redirect()->away($session->url);
    }

    public function success(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $session = Session::retrieve($request->get('session_id'));

            if ($session->payment_status === 'paid')
            {
                $user = Auth::user();
                $user->verification_status = 'verified';
                $user->save();

                if ($user->role == 'client')
                    $price = 29.99;
                else
                    $price = 15.99;

                Payment::create([
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'price' => $price,
                ]);

                return redirect()->route('dashboard')->with('success', 'Payment successful! Your account is now Verified.');
            }
        } catch (\Exception $e){
            return redirect()->route('dashboard')->with('error', 'Payment verification failed.');
        }

        return redirect()->route('dashboard')->with('error', 'Payment was not completed.');
    }

    public function cancel()
    {
        return redirect()->route('dashboard')->with('error', 'Payment was cancelled.');
    }
}
