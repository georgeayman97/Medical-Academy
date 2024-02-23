<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class SearchController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->filter(
            request(['search','course_year','doctor'])
        )->get();

        $users = User::latest()->filter(
            request(['search'])
        )->get();

        $j = 0;
        $doctors[0][0] = 0;
        foreach(Course::all() as $course){
            $repeated = false;
            for($i = 0;$i < count($doctors) ;$i++){
                if($course->doctor->id == $doctors[$i][0]){
                    $repeated = true;
                }
            }
            if($repeated == false){
                $doctors[$j][0] = $course->doctor->id;
                $doctors[$j][1] = $course->doctor->name;
                $doctors[$j][2] = Course::where('instructor_name',$course->doctor->id)->count();
                $j++; 
            }
        }

        $y = 0;
        $years[0][0] = 0;
        foreach(Course::all() as $course){
            $repeated = false;
            for($i = 0;$i < count($years) ;$i++){
                if($course->course_year == $years[$i][0]){
                    $repeated = true;
                }
            }
            if($repeated == false){
                $years[$y][0] = $course->course_year;
                $years[$y][1] = Course::where('course_year',$course->course_year)->count();
                $y++; 
            }
        }
        
        $success = session()->get('success');
        return view('admin.search.index',[
            'users' => $users,
            'courses' => $courses,
            'currentDoctor' => request('doctor'),
            'currentYear' => request('year'),
            'years' => $years,
            'doctors' => $doctors,
            'title' => 'Courses List',
            'success' => $success,
        ]);
        
    }
}
