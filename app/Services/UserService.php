<?php

// app/Services/UserService.php
namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function createUser($name, $email, $password, $timezone, $token)
    {
        return User::create([
            'email' => $email,
            'name' => $name,
            'password' => Hash::make($password),
            'token' => $token,
            'timezone' => $timezone,
            'token_expires_at' => now()->addDays(7),
        ]);
    }

    public function assignUserRole(User $user): void
    {
        try {
            $user->assignRole('user');
        } catch (Exception $e) {
            // Handle exception if needed
        }
    }
}
