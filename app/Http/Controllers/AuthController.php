<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequests;
use App\Services\AuthServices;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthServices $authService)
    {
        $this->authService = $authService;
    }

    public function register(AuthRequests $request): object
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

        return $this->jsonResponse(['auth_token' => $token], 200, 'User logged in successfully.');
    }

    public function logout(Request $request): object
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'User logout successfully.']);
    }
}
