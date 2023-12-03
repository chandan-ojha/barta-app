<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    //login page
    public function login_page()
    {

        return Inertia::render('Auth/Login');
    }

    //user login
    public function user_login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended()->with('message', 'Login successfully!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    //logout
    public function destroy()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
