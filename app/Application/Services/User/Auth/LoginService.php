<?php

namespace App\Application\Services\User\Auth;

use App\Domain\VO\Email;
use App\Domain\VO\Password;
use Illuminate\Support\Facades\Auth;

final class LoginService
{
    public function login(Email $email, string $password)
    {
        $credentials = ['email' => (string)$email, 'password' => (string)$password];
        try {
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $token = $user->createToken('token-name', ['*'], now()->addDay())->plainTextToken;

                return response()->json(['token' => $token, 'user' => $user], 200);
            }

            return response()->json(['error' => 'Unauthorized'], 401);
        } catch (\Exception $e) {
            return response()->json(['error' => "Failed to login user, {$e->getMessage()}"], 500);
        }
    }
}
