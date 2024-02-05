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
    public function index()
    {
        return Inertia::render('Profile/Index');
    }

    public function edit()
    {
        return Inertia::render('Profile/Edit');
    }

    public function update(StoreProfileRequest $request, User $user, ProfileService $profileService)
    {
        //$this->authorize('update', $user);

        $profileService->update($user, $request->validated());

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
