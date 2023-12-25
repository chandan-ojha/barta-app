<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class RegistrationController extends Controller
{
    //register page
    public function register_page()
    {
        return Inertia::render('Auth/Register');
    }

    // new user register
    public function create_user(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($user) {
            return redirect()->route('login')->with('success', 'Registration successfully done!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }
}
