<?php

namespace App\Services;

use App\Models\Log;

class LogService
{
    public function logLoginAttempt($user, $status)
    {
        Log::create([
            'user_id' => optional($user)->id,
            'event_type' => 'login_attempt',
            'event_description' => "Login attempt - Status: $status",
        ]);
    }

    public function logRegistrationData($user)
    {
        Log::create([
            'user_id' => $user->id,
            'event_type' => 'registration_data',
            'event_description' => 'User registered',
        ]);
    }

    public function logAddData($user, $data)
    {
        Log::create([
            'user_id' => $user->id,
            'event_type' => 'add_data',
            'event_description' => "Added data: $data",
        ]);
    }

    public function logRemoveData($user, $data)
    {
        Log::create([
            'user_id' => $user->id,
            'event_type' => 'remove_data',
            'event_description' => "Removed data: $data",
        ]);
    }
}
