<?php

namespace App\Services\Barta;

use App\Models\Post;
use Illuminate\Support\Facades\DB;

class CommentService
{
    //comment post logic
    public function comment_post(array $data)
    {
        DB::transaction(function () use ($data) {
            $data = array_merge([
                'user_id' => auth()->user()->id
            ], $data);

            $post = Post::findOrfail($data['post_id']);

            $post->comments()->create($data);
        }, 5);
    }

}
