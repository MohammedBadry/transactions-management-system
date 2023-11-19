<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\Api\Auth\LoginRequest;
use Validator;
use Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        /*
        $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
        'remember_me' => 'boolean'
        ]);
        */
        $credentials = request(['email','password']);
        if(!Auth::attempt($credentials))
        {
        return response()->json([
            'status' => false,
            'message' => 'Unauthorized',
            'data' => null
        ],401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Sucessful Login',
            'data' => ['token' => $token],
        ]);
    }
}
