<?php

namespace App\Http\Controllers\Barta;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AppController extends Controller
{
    //barta app
    public function barta_app()
    {
        $bartas = Post::orderBy('created_at', 'desc')->get();

        return Inertia::render(
            'BartaApp',
            [
                'bartas' => $bartas,
                //TODO: working on barta delete permission issue
                'can' => [
                    'barta_delete' => Auth::user()->can('delete', $bartas->first()),
                ],
            ]
        );
    }

    //barta detail
    public function barta_detail($id)
    {
        $barta = Post::find($id);
        $comments = $barta->comments()->orderBy('created_at', 'desc')->get();

        return Inertia::render(
            'BartaDetail',
            [
                'barta' => $barta,
                'comments' => $comments,
            ]
        );
    }
}
