<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


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
            return redirect()->route('login')->with('message', 'Registration successfully done!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }
}
