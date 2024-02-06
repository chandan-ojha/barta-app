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
        $user = User::query()->findOrFail($id);

        $this->authorize('view', $user);

        return Inertia::render('Profile/Index', [
            'user' => $user
        ]);
    }

    public function edit($id)
    {
        $user = User::query()->findOrFail($id);

        $this->authorize('view', $user);

        return Inertia::render('Profile/Edit', [
            'user' => $user
        ]);

    }

    public function update(StoreProfileRequest $request, User $user, ProfileService $profileService)
    {
        $this->authorize('update', $user);

        $profileService->update($user, $request->validated());

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

}
