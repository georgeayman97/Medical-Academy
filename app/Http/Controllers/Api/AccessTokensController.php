<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
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
        ->orWhere('mobile', $request->username)
        ->first();

        if(!$user || !Hash::check($request->password , $user->password)){
            return Response::json([
                'message' => 'Invalid username and password',
            ], 401);
        }
        if($user->status != User::STATUS_ACTIVE){
            return Response::json([
                'message' => 'Your Account not Activated',
            ], 401);
        }

        if($user->device_name == 'Admin_registeration'){
            $user->device_name = $request->device_name;
        }
        $user->faculty_id = (int)$user->faculty_id;
        $user->save();
        if($request->username == '01000000055' && $user->status == User::STATUS_ACTIVE){
            $token = $user->createToken($request->device_name);
            $user->logged_in = true;
            $user->save();
            return Response::json([
                'token' => $token->plainTextToken,
                'user' => $user,
            ]);
        }else

        if($request->device_name == $user->device_name && $user->status == User::STATUS_ACTIVE){
            $token = $user->createToken($request->device_name);
            $user->logged_in = true;
            $user->save();
            return Response::json([
                'token' => $token->plainTextToken,
                'user' => $user,
            ]);
        }else{
            return Response::json([
                'message' => 'Sorry you are logged in another mobile'
            ], 401);
        }
        

        
    }

    public function show()
    {
        $user = Auth::guard('sanctum')->user();
        $faculty = Faculty::select('name')->where('id',$user->faculty_id)->first();
        
        return Response::json([
            "name"=> $user->name,
            "email"=> $user->email,
            "mobile"=> $user->mobile,
            "year"=> $user->year,
            "status"=> $user->status,
            "logged_in"=> $user->logged_in,
            "device_name"=> $user->device_name,
            "faculty"=> $faculty->name
        ]);

        
    }

    public function destroy()
    {
        $user = Auth::guard('sanctum')->user();

        // Revoke (delete) all user tokens
        //$user->tokens()->delete();

        //Revoke current access token
        $user->logged_in = false;
        $user->save();
        
        $user->currentAccessToken()->delete();
    }
}
