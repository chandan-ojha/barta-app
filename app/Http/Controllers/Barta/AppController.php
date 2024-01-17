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
        $user = Auth::user();
        $bartas = Post::orderBy('created_at', 'desc')->withLikes()->get();

        foreach ($bartas as $barta) {
            $barta->is_liked = $barta->isLikedBy($user);
            $barta->is_disliked = $barta->isDislikedBy($user);
        }

        return Inertia::render(
            'BartaApp',
            [
                'bartas' => $bartas,
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
