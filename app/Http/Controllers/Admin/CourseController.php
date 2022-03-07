<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all()
        ->sortByDesc('name');

        // dd($courses);
        // also i have func called simplePaginate just next and previous no page num
        $success = session()->get('success');
        return view('admin.courses.index',[
            'courses' => $courses,
            'title' => 'Courses List',
            'success' => $success,
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $course = new Course();
        return view('admin.courses.createCourse',compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Course::validateRules());    
        
        if($request->hasFile('image')){
            $file = $request->file('image'); // upload file opject
            // $file->getClientOriginalName(); // returns file name
            $image_path = $file->store('/' , 'uploads');
            /* File system Disks (config/filesystem)
             local: storage/app
             public: storage/app/public
             s3: amazon Drive
             custom: define by us*/
             $request->merge([
                'image_path' => $image_path,
            ]);
        }
        $request->merge([
            'slug' => Str::slug($request->name),
        ]);
        Course::create($request->all());

        return redirect(route('dashboard'));
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
        $course = Course::findOrFail($id);
        // withTrashed()  used for including soft deleted items 
        // onlyTrashed()  find just deleted items
        return view('admin.courses.editCourse',[
            'course' => $course,
        ]);
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
        $course = Course::findOrFail($id);
        $request->validate(Course::validateRules());

        //here we will handle the file to store it in a place
        if($request->hasFile('image')){
            $file = $request->file('image'); // upload file opject
            // $file->getClientOriginalName(); // returns file name
            $image_path = $file->store('/' , 'uploads');
            /* File system Disks (config/filesystem)
             local: storage/app
             public: storage/app/public
             s3: amazon Drive
             custom: define by us*/
             $request->merge([
                'image_path' => $image_path,
            ]);
        }
        
        $course->update($request->all());
        return redirect()->route('dashboard')->with('success',"$course->name Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $course = Course::findOrFail($id);
        $course->delete();

        // delete image from uploads disk
        Storage::disk('uploads')->delete($course->image_path);

        // same idea in native php
        //unlink(public_path('uploads/'. $product->image_path));

        
        return redirect()->route('courses.index')->with('success',"$course->name Deleted Successfully");

    }
}
