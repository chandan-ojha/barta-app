<?php

namespace App\Http\Controllers\Barta;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\User;
use App\Models\Post;
use App\Services\Barta\AppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AppController extends Controller
{
    /*
     * Barta App
    */
    public function barta_app(Request $request)
    {
        $filters = $request->only('search', 'tag');

        $user = Auth::user();

        $bartas = Post::with(['user:id,first_name,last_name,avatar'])
            ->filter($filters, $user)
            ->withLikes()
            ->withComments()
            ->latest()
            ->get()
            ->map(function ($barta) use ($user) {
                $barta->is_liked = $barta->isLikedBy($user);
                $barta->is_disliked = $barta->isDislikedBy($user);
                return $barta;
            });

        $tags = Tag::select('id', 'title')
            ->withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->limit(5)
            ->get();

        $follow_list = User::select('id', 'first_name', 'last_name', 'avatar')
            ->whereNotIn('id', function ($query) use ($user) {
                $query->select('following_user_id')
                    ->from('follows')
                    ->where('user_id', $user->id);
            })
            ->where('id', '!=', $user->id)
            ->inRandomOrder()
            ->limit(3)
            ->get();

        return Inertia::render(
            'BartaApp',
            compact('bartas', 'follow_list', 'tags')
        );
    }

    /*
     * Barta Detail
    */
    public function barta_detail($id)
    {
        $barta = Post::find($id);

        if (!$barta) {
            return redirect()->route('barta-app');
        }

        $barta->load('user:id,first_name,last_name,avatar');

        $comments = $barta->comments()
            ->with([
                'user:id,first_name,last_name,avatar',
            ])
            ->orderBy('created_at', 'desc')
            ->get();

        return Inertia::render('BartaDetail', compact('barta', 'comments'));
    }

    /*
     * Barta Search (Not Implemented this method)
     * Testing purpose for Pipeline Design Pattern (Still not working)
    */
    public function barta_search(Request $request, AppService $appService)
    {
        $search_key = $request->input('search_key');

        $bartas = $appService->get([
            'body' => $search_key
        ]);

        return response()->json($bartas);
    }

}
