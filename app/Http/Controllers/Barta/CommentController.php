<?php

namespace App\Http\Controllers\Barta;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //comment post
    public function comment_post(Request $request)
    {
        $request->validate([
            'body' => 'required'
        ]);

        $post = Post::findOrfail($request->post_id);

        $post->comments()->create([
            'body' => $request->body,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->back()->with('message', 'Comment posted successfully!');
    }
}
