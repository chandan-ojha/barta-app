<?php

namespace App\Http\Controllers\Barta;

use App\Http\Controllers\Controller;
use App\Http\Requests\Barta\StorePostRequest;
use App\Models\Post;
use App\Services\Barta\PostService;

class PostController extends Controller
{
    //barta post
    public function barta_post(StorePostRequest $request, PostService $postService)
    {
        $postService->barta_post($request->validated());

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
