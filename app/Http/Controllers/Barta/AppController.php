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
        $bartas = Post::orderBy('created_at', 'desc')
            ->with([
                'user:id,first_name,last_name,avatar',
            ])
            ->withLikes()
            ->withComments()
            ->get();

        foreach ($bartas as $barta) {
            $barta->is_liked = $barta->isLikedBy($user);
            $barta->is_disliked = $barta->isDislikedBy($user);
            $barta->user->avatar = $barta->user->image_url;
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

        if (!$barta) {
            return redirect()->route('barta-app');
        }

        $barta->load('user:id,first_name,last_name,avatar');

        $barta->user->avatar = $barta->user->image_url;

        $comments = $barta->comments()
            ->with([
                'user:id,first_name,last_name,avatar',
            ])
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($comments as $comment) {
            $comment->user->avatar = $comment->user->image_url;
        }

        return Inertia::render(
            'BartaDetail',
            [
                'barta' => $barta,
                'comments' => $comments,
            ]
        );
    }
}
