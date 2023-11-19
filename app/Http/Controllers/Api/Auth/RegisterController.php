<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\Api\Auth\RegisterRequest;
use Validator;
use Auth;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        /*
        $request->validate([
            'name' => 'required|string',
            'email'=>'required|string|unique:users',
            'password'=>'required|string',
            'c_password' => 'required|same:password'
        ]);
        */
        $user = User::create([
            'name'  => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if($user->save()){
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->plainTextToken;

            return response()->json([
                'status' => true,
                'message' => 'Successfully created user!',
                'data'=> [ 'token' => $token],
            ]);
        } else{
            return response()->json(['status' => false, 'message'=>'Provide proper details', 'data' => null]);
        }
    }

}
