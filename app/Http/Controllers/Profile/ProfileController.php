<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\StoreProfileRequest;
use App\Models\User;
use App\Services\Profile\ProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function show($id)
    {
        $user = User::with([
            'posts' => function ($query) {
                $query->select('id', 'user_id', 'body', 'created_at')
                    ->withCount('comments')
                    ->latest();
            },
        ])
            ->where('id', $id)
            ->select('id', 'first_name', 'last_name', 'avatar', 'bio', 'created_at')
            ->withCount([
                'posts as total_posts',
                'posts as total_comments' => function ($query) {
                    $query->select(DB::raw('COALESCE(SUM((SELECT COUNT(*) from comments WHERE comments.post_id = posts.id)), 0)'));
                }
            ])
            ->firstOrFail();

        $is_following = auth()->user()->following($user);

        $following_list = User::find($id)->follows()->get();

        $followers_list = User::find($id)->followers()->get();

        return Inertia::render('Profile/Index', [
            'user' => $user,
            'is_following' => $is_following,
            'following_list' => $following_list,
            'followers_list' => $followers_list
        ]);
    }

    public function edit($id)
    {
        $user = User::query()->findOrFail($id);

        $this->authorize('update', $user);

        return Inertia::render('Profile/Edit', [
            'user' => $user
        ]);

    }

    public function update(StoreProfileRequest $request, $id, ProfileService $profileService)
    {
        $user = User::query()->findOrFail($id);

        $this->authorize('update', $user);

        $profileService->update(
            $user,
            $request->validated(),
            $request->hasFile('avatar') ? $request->file('avatar') : null
        );

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

}
