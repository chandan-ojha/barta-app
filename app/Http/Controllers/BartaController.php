<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Post;

class BartaController extends Controller
{
    public function barta_app()
    {
        $bartas = Post::orderBy('created_at', 'desc')->get();
        return Inertia::render('BartaApp',
            [
                'bartas' => $bartas
            ]
        );
    }

    public function barta_detail($id)
    {
        $barta = Post::find($id);
        return Inertia::render('BartaDetail',
             [
                'barta' => $barta
             ]
        );
    }

    public function barta_post(Request $request)
    {
        $post = new Post();
        $post->body = $request->body;
        $post->save();

        return redirect()->back()->with('message', 'Barta created successfully!');

    }
}
