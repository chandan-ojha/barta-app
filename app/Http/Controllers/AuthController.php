<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AuthController extends Controller
{
    //login
    public function login()
    {
        return Inertia::render('Login');
    }

    //register
    public function register()
    {
        return Inertia::render('Register');
    }

}
