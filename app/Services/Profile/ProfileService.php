<?php

namespace App\Services\Profile;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class ProfileService
{
    public function update(User $user, array $data, $avatar = null): void
    {
        DB::transaction(function () use ($user, $data, $avatar) {
            $user->update($data);

            if ($avatar) {
                $user->update([
                    'avatar' => $avatar->store('avatars', 'public')
                ]);
            }
        }, 5);
    }

}
