<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthServices{
    public function createUser(array $data): void
    {
        $user = new User();
        $user->email = $data['email'];
        $user->name = $data['name'];
        $user->password = Hash::make($data['password']);
        $user->save();
    }

    public function authUser(array $data): ?string
    {
        $user = User::where('email', $data['email'])->first();

        if(!$user || !Hash::check($data['password'], $user->password)){
            return null;
        }

        return $user->createToken('authToken')->plainTextToken;
    }
}
