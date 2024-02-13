<?php

namespace App\Services\Barta;

use App\Filters\BartaFilter;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class AppService
{
    public function get(array $queryParams = [])
    {
        $user = Auth::user();

        $queryBuilder = Post::with(['user:id,first_name,last_name,avatar'])
            ->withLikes()
            ->withComments()
            ->latest()
            ->get()
            ->map(function ($barta) use ($user) {
                //$barta->is_liked = $barta->isLikedBy($user);
                //$barta->is_disliked = $barta->isDislikedBy($user);
                $barta->user->avatar = $barta->user->image_url;
                return $barta;
            });

        $bartas = resolve(BartaFilter::class)->getResults([
            'builder' => $queryBuilder,
            'params' => $queryParams
        ]);

        return $bartas;
    }

}
