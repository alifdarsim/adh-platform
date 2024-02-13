<?php

namespace App\Services;

use App\Models\User;

class EmailConfirmationService
{
    public function confirmEmail($token): bool
    {
        $user = User::where('token', $token)->where('token_expires_at', '>=', now())->first();

        if ($user) {
            $user->update(['token' => null, 'token_expires_at' => null, 'status' => 1]);
            return true;
        }

        return false;
    }
}
