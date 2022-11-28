<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login', 'register']]);
    // }


    public function login(Request $request)
    {

        $credentials = $request->only(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {

            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function register(Request $request)
    {
        if(auth()->user()){

            return back();
        }

        $validated = $request->validate([
            'email' => 'required|unique:users|max:255',
            'password' => 'min:5|max:255',
        ]);

        $user = User::create($validated);
        return $user->setToken('eyJhb...');

    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
