<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Response;

class RegisteredUserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable','string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'mobile' => ['required', 'string', 'min:11','unique:users'],
            'year' => ['required', 'string', 'max:255'],
            'device_name' => ['required'],
            'faculty_id' => ['required']
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'year' => $request->year,
            'faculty_id' => $request->faculty_id,
            'status' => User::STATUS_REQUEST,
            'device_name' => $request->device_name,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        return Response::json([
            
            'user' => $user,
            
        ], 200);
    }
    
    public function forget_password(Request $request){
        
        $user = User::where('mobile',$request->mobile)->first();
        $user->forget_password = 1;
        $user->save();
        return Response::json([
            
            'message' => "Request submitted successfully",
            
        ], 200);
    }

    public function course_search(Request $request){
        $user = Auth::guard('sanctum')->user();
        $courses = Course::where('name', 'like', '%' . $request->course . '%')->get();
        if($courses->count() != 0){
            foreach($courses as $course){
            $course->instructor_name = User::where('id',$course->instructor_name)->pluck('name')->first();
            $course->image_path = 'http://medicalonlineacademy.com/uploads/'.$course->image_path;
            $course->subject_id = Subject::where('id',$course->subject_id)->pluck('name')->first();
            }
            return Response::json([
            
            'courses' => $courses,
            
        ], 200);
        }else{
        return Response::json([
            
            'message' => "no courses found",
            
        ], 401);
        }
    }

}
