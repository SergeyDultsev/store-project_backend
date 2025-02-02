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
        return $this->jsonResponse([], 201, 'User registered successfully.');
    }

    public function login(AuthRequests $request): object
    {
        $userData = $this->authService->authUser($request->all());

        if (!$userData) {
            return $this->jsonResponse([], 401, 'There is no such account.');
        }

        return $this->jsonResponse([
            'id' => $userData['id'],
            'name' => $userData['name'],
            'email' => $userData['email'],
        ], 200, 'User logged in successfully.')
            ->cookie(
                'auth_token',
                $userData['token'] ?? '',
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
        return $this->jsonResponse([], 200, 'User logout successfully.')
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

    public function check(Request $request): object
    {
        $userStateAuth = auth()->check();

        if(!$userStateAuth){
            return $this->jsonResponse(['authorized' => false], 200, 'User not authorized');
        }

        return $this->jsonResponse(['authorized' => true], 200, 'User authorized.');
    }
}
