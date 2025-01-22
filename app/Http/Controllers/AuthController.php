<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequests;
use App\Http\Requests\RegisterRequests;
use App\Services\AuthServices;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthServices $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequests $request): object
    {
        $this->authService->createUser($request->all());
        return response()->json(['message' => 'User registered successfully.']);
    }

    public function login(AuthRequests $request): object
    {
        $token = $this->authService->authUser($request->all());

        if (!$token) {
            return $this->jsonResponse([], 401, 'Invalid credentials');
        }

        return response()->json(['message' => 'User logged in successfully.'])
            ->cookie(
                'auth_token',
                $token,
                60 * 24,
                '/',
                null,
                false,
                true
            );
    }

    public function logout(Request $request): object
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'User logout successfully.'])
            ->cookie(
                'auth_token',
                '',
                -1,
                '/',
                null,
                false,
                true
            );
    }
}
