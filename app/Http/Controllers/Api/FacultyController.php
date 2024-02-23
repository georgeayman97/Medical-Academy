<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseAccess;
use App\Models\Faculty;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faculties = Faculty::select('id','name','years')->get();
        
        return response()->json([
            'faculties' => $faculties,
        ], 200);
    }

    public function userCourses()
    {
        $user = Auth::guard('sanctum')->user();
        // $userCourses = CourseAccess::with('course')->where('user_id',$user->id)->get();
        $userCourses = CourseAccess::whereHas('course', function ($query) {
            return $query->where('status',Course::STATUS_ACTIVE);
        })->where('user_id',$user->id)->get();
        foreach($userCourses as $course){
            $course->course->subject_id = (int)$course->course->subject_id;
            $course->course->instructor_name = User::where('id',$course->course->instructor_name)->pluck('name')->first();
            $course->course->image_path = 'http://medicalonlineacademy.com/uploads/'.$course->course->image_path;
        }
        $userCourses = $userCourses->map(fn($c) =>[
                'status' => $c->status,
                'course' => $c->course
            ]);

        return response()->json([
            'userCourses' => $userCourses,
        ], 200);
    }

    public function facultyYears(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $faculties = Faculty::select('years')->where('id',$user->faculty_id)->get();
        
        return response()->json([
            'faculties' => $faculties,
        ], 200);
    }

    public function facultySubjects(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $subjects = Subject::select('id','name','description','image_path','year')->where('faculty_id',$user->faculty_id)->where('year',$request->year)->get();
        foreach($subjects as $subject){
            $subject->setAttribute('courses_number', Course::where('subject_id',$subject->id)->count());
            if($subject->image_path != null)
            $subject->image_path = 'http://medicalonlineacademy.com/uploads/'.$subject->image_path;
        }
        return response()->json([
            'subjects' => $subjects,
        ], 200);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
