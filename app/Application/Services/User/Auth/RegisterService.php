<?php

namespace App\Application\Services\User\Auth;

use App\Domain\VO\Email;
use App\Domain\VO\Password;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterService
{
    public function register($name, Email $email, string $password)
    {
        try {
            User::create([
                'name' => $name,
                'email' => (string)$email,
                'password' => Hash::make((string)$password),
            ]);
            return response()->json(['message' => 'User registered successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => "Failed to register user, {$e->getMessage()}"], 500);
        }
    }
}
