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

    public function register(AuthRequests $request){

    }

    public function login(AuthRequests $request){

    }

    public function logout(Request $request){

    }
}
