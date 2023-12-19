<?php

namespace App\Http\Controllers\Barta;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //barta post
    public function barta_post(Request $request)
    {
        $request->validate([
            'body' => 'required'
        ]);

        Post::create([
            'body' => $request->body,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->back()->with('message', 'Barta created successfully!');
    }

    //barta delete
    public function barta_delete($id)
    {
        $post = Post::find($id);
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->back()->with('message', 'Barta deleted successfully!');
    }


}
