<?php

namespace App\Services\Barta;

use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostService
{
    //barta post logic
    public function barta_post(array $data)
    {
        DB::transaction(function () use ($data) {
            $data = array_merge([
                'user_id' => auth()->user()->id
            ], $data);

            Post::create($data);
        }, 5);
    }

}
