<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Domain\VO\Email;
use App\Domain\VO\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use App\Application\Services\User\Auth\LoginService;
use App\Application\Services\User\Auth\RegisterService;
use App\Application\Services\User\Auth\VerifyTokenService;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $loginService = new LoginService;

        $response = $loginService->login(
            email: new Email($credentials['email']),
            password: $credentials['password']
        );

        return $response;
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $registerService = new RegisterService;
        return $registerService->register(
            name: $request->name,
            email: new Email($request->email),
            password: $request->password
        );
    }

    public function validateToken(Request $request)
    {
        $token = $request->bearerToken();
        if (!$token) {
            return response()->json(['error' => 'Token não fornecido'], 401);
        }
        $verifyTokenService = new VerifyTokenService();
        return $verifyTokenService->validateToken($token);
    }
}
