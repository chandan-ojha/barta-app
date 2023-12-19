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
        $post = Post::findOrfail($request->post_id);
        $comment = new Comment();
        $comment->body = $request->body;
        $post->comments()->save($comment);

        return redirect()->back()->with('message', 'Comment posted successfully!');
    }
}
