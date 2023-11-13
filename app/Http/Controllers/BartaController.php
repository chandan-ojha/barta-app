<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class BartaController extends Controller
{
    public function index()
    {
        return Inertia::render('Barta');
    }

    public function single_barta()
    {
        return Inertia::render('SingleBarta');
    }


}
