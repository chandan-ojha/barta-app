<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Inertia\Inertia;

class AuthController extends Controller
{
    //register page
    public function register_page()
    {
        return Inertia::render('Register');
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
            return redirect()->route('login')->with('message', 'User created successfully!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    //login page
    public function login_page()
    {

        return Inertia::render('Login');
    }

    //user login
    public function user_login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {

            // $request->session()->regenerate();

            $token = Crypt::encrypt($user->createToken('authToken')->plainTextToken);

            $cookie = cookie('jwt', $token, 60 * 24); // 1 day

            return redirect()->route('barta-app')->with('message', 'login successfully!')->withCookie($cookie);

        } else {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

}
