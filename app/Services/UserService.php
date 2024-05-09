<?php

// app/Services/UserService.php
namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function createUser($name, $email, $password, $timezone, $token, $phone, $phone_code, $referer_code): User
    {
        $referer_id = User::where('referer_code', $referer_code)->value('id');
        return User::create([
            'email' => $email,
            'name' => $name,
            'password' => Hash::make($password),
            'token' => $token,
            'timezone' => $timezone,
            'phone' => $phone,
            'phone_code' => $phone_code,
            'referer_code' => $this->generateRandomString(),
            'referer_id' => $referer_id,
            'token_expires_at' => now()->addDays(7),
        ]);
    }

    public function assignUserRole(User $user, $role): void
    {
        $user->role = $role;
        $user->save();
    }

    public function generateRandomString($length = 6) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return strtoupper($randomString);
    }
}
