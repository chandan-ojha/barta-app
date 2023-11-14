<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class BartaController extends Controller
{
    public function barta_app()
    {
        return Inertia::render('BartaApp');
    }

    public function barta_detail()
    {
        return Inertia::render('BartaDetail');
    }


}
