<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

trait Commentable
{
    //total comments count for each post
    public function scopeWithComments(Builder $query): void
    {
        $query->leftJoinSub(
            'select post_id, count(id) total_comments from comments group by post_id',
            'comments',
            'comments.post_id',
            'posts.id'
        );
    }

}
