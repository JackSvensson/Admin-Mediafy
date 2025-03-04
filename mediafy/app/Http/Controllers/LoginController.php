<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect with a success message for screen readers
            return redirect('/panel')->with('success', 'Successfully logged in');
        }

        // More descriptive error messages for accessibility
        return back()->withInput($request->only('email'))
            ->withErrors([
                'login' => 'The provided credentials do not match our records. Please check your email and password.'
            ]);
    }
}
