<?php

namespace App\Services\Profile;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class ProfileService
{
    public function update(User $user, array $data): void
    {
        DB::transaction(function () use ($user, $data) {
            $user->update($data);
        }, 5);
    }

}
