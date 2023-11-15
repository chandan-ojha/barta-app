<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Post;
use App\Models\Comment;

class BartaController extends Controller
{
    //barta app
    public function barta_app()
    {
        $bartas = Post::orderBy('created_at', 'desc')->get();
        return Inertia::render('BartaApp',
            [
                'bartas' => $bartas
            ]
        );
    }

    //barta detail
    public function barta_detail($id)
    {
        $barta = Post::find($id);
        $comments = $barta->comments()->orderBy('created_at', 'desc')->get();
        return Inertia::render('BartaDetail',
             [
                'barta' => $barta,
                'comments' => $comments
             ]
        );
    }

    //barta post
    public function barta_post(Request $request)
    {
        $post = new Post();
        $post->body = $request->body;
        $post->save();

        return redirect()->back()->with('message', 'Barta created successfully!');
    }

    //comment post
    public function comment_post(Request $request)
    {
        $post = Post::findOrfail($request->post_id);
        $comment = new Comment();
        $comment->body = $request->body;
        $post->comments()->save($comment);

        return redirect()->back()->with('message', 'Comment posted successfully!');
    }
}
