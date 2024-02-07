<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\StoreProfileRequest;
use App\Models\User;
use App\Services\Profile\ProfileService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function show($id)
    {
        $user = User::query()->findOrFail($id)->load('posts', 'comments');

        $this->authorize('view', $user);

        return Inertia::render('Profile/Index', [
            'user' => $user
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

        $profileService->update($user, $request->only('first_name', 'last_name', 'avatar', 'bio'));

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

}
