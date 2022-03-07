<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class AccessTokensController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'username' => ['required'],
            'password' => ['required'],
            'device_name' => ['required'],
        ]);

        $user = User::where('email' , $request->username)
        ->first();

        if(!$user || !Hash::check($request->password , $user->password)){
            return Response::json([
                'message' => 'Invalid username and password',
            ], 401);
        }

        $token = $user->createToken($request->device_name);

        return Response::json([
            'token' => $token->plainTextToken,
            'user' => $user,
        ]);
    }

    public function destroy()
    {
        $user = Auth::guard('sanctum')->user();

        // Revoke (delete) all user tokens
        //$user->tokens()->delete();

        //Revoke current access token
        $user->currentAccessToken()->delete();
    }
}
