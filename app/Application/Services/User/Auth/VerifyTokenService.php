<?php

namespace App\Application\Services\User\Auth;

use Laravel\Sanctum\PersonalAccessToken;

final class VerifyTokenService
{
    public function validateToken(string $token)
    {
        $accessToken = PersonalAccessToken::findToken($token);
        if (!$accessToken || $accessToken->expires_at->isPast()) {
            return response()->json(['error' => 'Token inválido ou expirado'], 401);
        }

        return response()->json(['message' => 'Token válido'], 200);
    }
}
