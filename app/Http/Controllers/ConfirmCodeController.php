<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfirmCodeController extends Controller
{
    public function index()
    {
        // If user is already verified, redirect to home
        if (auth()->user()->hasVerifiedCode()) {
            return redirect()->route('frontend.home');
        }
        return view('frontend.confirm-code');
    }

    //confirmCode function
    public function confirmCode(Request $request)
    {
        // Validate the request
        $request->validate([
            'code' => 'required|min:5|max:5',
        ]);
        // Check if the code is correct
        if ($request->code == auth()->user()->registration_code) {
            // If the code is correct, update the user's code_verified_at column
            auth()->user()->markCodeAsVerified();
            // Redirect to home
            return redirect()->route('frontend.home');
        }
        // If the code is incorrect, redirect back with an error message
        return redirect()->back()->withErrors(['code' => 'Kod koji ste uneli je neispravan.']);
    }
}
