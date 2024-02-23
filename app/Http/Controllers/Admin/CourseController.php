<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Str;
use App\Models\CourseAccess;
use App\Models\UserTracking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Support\Facades\Session;
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

        // $nameOfDoctors = Course::all()->load('doctor')->pluck('doctor.name','doctor.id')->unique();
        // $users = User::latest()->filter(
        //     request(['search'])
        // )->get();
        $j = 0;
        $doctors[0][0] = 0;
        foreach ($courses as $course) {
            $repeated = false;
            for ($i = 0; $i < count($doctors); $i++) {
                if ($course->doctor->id == $doctors[$i][0]) {
                    $repeated = true;
                }
            }
            if ($repeated == false) {
                $doctors[$j][0] = $course->doctor->id;
                $doctors[$j][1] = $course->doctor->name;
                $doctors[$j][2] = Course::where('instructor_name', $course->doctor->id)->count();
                $j++;
            }
        }

        $y = 0;
        $years[0][0] = 0;
        foreach (Course::all() as $course) {
            $repeated = false;
            for ($i = 0; $i < count($years); $i++) {
                if ($course->course_year == $years[$i][0]) {
                    $repeated = true;
                }
            }
            if ($repeated == false) {
                $years[$y][0] = $course->course_year;
                $years[$y][1] = Course::where('course_year', $course->course_year)->count();
                $y++;
            }
        }

        // also i have func called simplePaginate just next and previous no page num
        $success = session()->get('success');
        return view('admin.courses.index', [
            'courses' => $courses,
            'doctors' => $doctors,
            'years' => $years,
            'title' => 'Courses List',
            'success' => $success,
        ]);
    }

    public function active()
{
    $courses = Course::where('status',Course::STATUS_ACTIVE)->get()
        ->sortByDesc('name');

    // $nameOfDoctors = Course::all()->load('doctor')->pluck('doctor.name','doctor.id')->unique();
    // $users = User::latest()->filter(
    //     request(['search'])
    // )->get();
    $j = 0;
    $doctors[0][0] = 0;
    foreach ($courses as $course) {
        $repeated = false;
        for ($i = 0; $i < count($doctors); $i++) {
            if ($course->doctor->id == $doctors[$i][0]) {
                $repeated = true;
            }
        }
        if ($repeated == false) {
            $doctors[$j][0] = $course->doctor->id;
            $doctors[$j][1] = $course->doctor->name;
            $doctors[$j][2] = Course::where('instructor_name', $course->doctor->id)->where('status',Course::STATUS_ACTIVE)->count();
            $j++;
        }
    }

    $y = 0;
    $years[0][0] = 0;
    foreach ($courses as $course) {
        $repeated = false;
        for ($i = 0; $i < count($years); $i++) {
            if ($course->course_year == $years[$i][0]) {
                $repeated = true;
            }
        }
        if ($repeated == false) {
            $years[$y][0] = $course->course_year;
            $years[$y][1] = Course::where('course_year', $course->course_year)->where('status',Course::STATUS_ACTIVE)->count();
            $y++;
        }
    }

    // also i have func called simplePaginate just next and previous no page num
    $success = session()->get('success');
    return view('admin.courses.index', [
        'courses' => $courses,
        'doctors' => $doctors,
        'years' => $years,
        'status' => 'active',
        'title' => 'Courses List',
        'success' => $success,
    ]);
}
    public function disabled()
    {
        $courses = Course::where('status',Course::STATUS_DISABLED)->get()
            ->sortByDesc('name');

        // $nameOfDoctors = Course::all()->load('doctor')->pluck('doctor.name','doctor.id')->unique();
        // $users = User::latest()->filter(
        //     request(['search'])
        // )->get();
        $j = 0;
        $doctors[0][0] = 0;
        foreach ($courses as $course) {
            $repeated = false;
            for ($i = 0; $i < count($doctors); $i++) {
                if ($course->doctor->id == $doctors[$i][0]) {
                    $repeated = true;
                }
            }
            if ($repeated == false) {
                $doctors[$j][0] = $course->doctor->id;
                $doctors[$j][1] = $course->doctor->name;
                $doctors[$j][2] = Course::where('instructor_name', $course->doctor->id)->where('status',Course::STATUS_DISABLED)->count();
                $j++;
            }
        }

        $y = 0;
        $years[0][0] = 0;
        foreach ($courses as $course) {
            $repeated = false;
            for ($i = 0; $i < count($years); $i++) {
                if ($course->course_year == $years[$i][0]) {
                    $repeated = true;
                }
            }
            if ($repeated == false) {
                $years[$y][0] = $course->course_year;
                $years[$y][1] = Course::where('course_year', $course->course_year)->where('status',Course::STATUS_DISABLED)->count();
                $y++;
            }
        }

        // also i have func called simplePaginate just next and previous no page num
        $success = session()->get('success');
        return view('admin.courses.index', [
            'courses' => $courses,
            'doctors' => $doctors,
            'years' => $years,
            'status' => Course::STATUS_DISABLED,
            'title' => 'Courses List',
            'success' => $success,
        ]);
    }
    public function action(Request $request)
    {
        $coursesAccesses = $request->input('users');
        $action = $request->input('action');

        if ($action == 'enroll') {
            CourseAccess::whereIn('id', $coursesAccesses)->update(['status' => CourseAccess::STATUS_ENROLLED]);
            return redirect()->back()->with('success', 'Selected users marked as Enrolled!');
        } elseif ($action == 'disable') {
            CourseAccess::whereIn('id', $coursesAccesses)->update(['status' => CourseAccess::STATUS_DISABLED]);
            return redirect()->back()->with('success', 'Selected users marked as Disabled!');
        } else {
            return redirect()->back()->with('error', 'Invalid action!');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctors = User::where('role', 'doctor')->get();
        $course = new Course();
        $subjects = Subject::with('faculty')->get();
        return view('admin.courses.createCourse', compact('course', 'doctors', 'subjects'));
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
        if ($request->hasFile('image')) {

            $file = $request->file('image'); // upload file opject
            // $file->getClientOriginalName(); // returns file name
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);

            /* File system Disks (config/filesystem)
             local: storage/app
             public: storage/app/public
             s3: amazon Drive
             custom: define by us*/
            $request->merge([
                'image_path' => $filename,
            ]);
        }
        $request->merge([
            'slug' => Str::slug($request->name),
        ]);
        Course::create($request->all());

        return redirect(route('dashboard'));
    }

    public function filtering()
    {
        $courses = Course::latest()->filter(
            request(['course_year', 'doctor'])
        )->get();

        $j = 0;
        $doctors[0][0] = 0;
        foreach (Course::all() as $course) {
            $repeated = false;
            for ($i = 0; $i < count($doctors); $i++) {
                if ($course->doctor->id == $doctors[$i][0]) {
                    $repeated = true;
                }
            }
            if ($repeated == false) {
                $doctors[$j][0] = $course->doctor->id;
                $doctors[$j][1] = $course->doctor->name;
                $doctors[$j][2] = Course::where('instructor_name', $course->doctor->id)->count();
                $j++;
            }
        }

        $y = 0;
        $years[0][0] = 0;
        foreach (Course::all() as $course) {
            $repeated = false;
            for ($i = 0; $i < count($years); $i++) {
                if ($course->course_year == $years[$i][0]) {
                    $repeated = true;
                }
            }
            if ($repeated == false) {
                $years[$y][0] = $course->course_year;
                $years[$y][1] = Course::where('course_year', $course->course_year)->count();
                $y++;
            }
        }


        $success = session()->get('success');
        return view('admin.courses.index', [
            'courses' => $courses,
            'currentDoctor' => request('doctor'),
            'currentYear' => request('year'),
            'years' => $years,
            'doctors' => $doctors,
            'title' => 'Courses List',
            'success' => $success,
        ]);
    }
    public function filteringCourses($status)
    {
        $courses = Course::where('status',$status)->filter(
            request(['course_year', 'doctor'])
        )->get();

        $j = 0;
        $doctors[0][0] = 0;
        foreach (Course::where('status',$status)->get() as $course) {
            $repeated = false;
            for ($i = 0; $i < count($doctors); $i++) {
                if ($course->doctor->id == $doctors[$i][0]) {
                    $repeated = true;
                }
            }
            if ($repeated == false) {
                $doctors[$j][0] = $course->doctor->id;
                $doctors[$j][1] = $course->doctor->name;
                $doctors[$j][2] = Course::where('instructor_name', $course->doctor->id)->where('status',$status)->count();
                $j++;
            }
        }

        $y = 0;
        $years[0][0] = 0;
        foreach (Course::where('status',$status)->get() as $course) {
            $repeated = false;
            for ($i = 0; $i < count($years); $i++) {
                if ($course->course_year == $years[$i][0]) {
                    $repeated = true;
                }
            }
            if ($repeated == false) {
                $years[$y][0] = $course->course_year;
                $years[$y][1] = Course::where('course_year', $course->course_year)->where('status',$status)->count();
                $y++;
            }
        }


        $success = session()->get('success');
        return view('admin.courses.index', [
            'courses' => $courses,
            'currentDoctor' => request('doctor'),
            'currentYear' => request('year'),
            'years' => $years,
            'doctors' => $doctors,
            'status' => 'active',
            'title' => 'Courses List',
            'success' => $success,
        ]);
    }
    public function enrollment($id)
    {
        $enrollment = CourseAccess::where('course_id', $id)->where('status', 'enrolled')->orderByDesc('created_at')->get()
            ->load('user');
        $enrollmentExport = CourseAccess::select('user_id', 'course_id', 'status','updated_at')->where('course_id', $id)->where('status', 'enrolled')->orderByDesc('created_at')->get()
            ->load('user', 'course');
        $usersviews = UserTracking::where('course_id', $id)->get()->pluck('watching_counter', 'user_id');
        Session::flash('enrolledUsers', $enrollmentExport);
        return view('admin.accounts.enrolled', compact('enrollment', 'usersviews'));
    }

    public function enrollmentCourses($id)
    {
        $enrollment = CourseAccess::where('user_id', $id)->orderByDesc('created_at')->get()
            ->load('user');
        // $usersviews = UserTracking::where('user_id', $id)->get()->pluck('watching_counter', 'user_id');
        return view('admin.accounts.enrolled_courses', compact('enrollment'));
    }

    public function enroll($id)
    {
        $courseEnrollment = CourseAccess::findOrFail($id);
        if ($courseEnrollment) {
            $courseEnrollment->status = CourseAccess::STATUS_ENROLLED;
            $courseEnrollment->save();
        }
        return back();
    }

    public function disable($id)
    {

        $courseEnrollment = CourseAccess::findOrFail($id);
        if ($courseEnrollment) {
            $courseEnrollment->status = CourseAccess::STATUS_DISABLED;
            $courseEnrollment->save();
        }
        return back();
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
        $doctors = User::where('role', 'doctor')->get();
        $course = Course::findOrFail($id);
        $subjects = Subject::with('faculty')->get();
        // withTrashed()  used for including soft deleted items
        // onlyTrashed()  find just deleted items
        return view('admin.courses.editCourse', [
            'course' => $course,
            'doctors' => $doctors,
            'subjects' => $subjects
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
        $request->validate([
            'name' => 'required|max:255',
            'instructor_name' => auth()->user()->role == 'doctor' ? 'max:255' : 'required|max:255',
            'description' => 'nullable',
            'image' => 'nullable|image',
            'price' => 'nullable|numeric|min:0',
            'sku' => 'nullable|unique:products,sku',
            'status' => 'in:' . Course::STATUS_ACTIVE . ',' . Course::STATUS_DISABLED,
        ]);

        //here we will handle the file to store it in a place
        if ($request->hasFile('image')) {
            $file = $request->file('image'); // upload file opject
            // $file->getClientOriginalName(); // returns file name
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);

            /* File system Disks (config/filesystem)
             local: storage/app
             public: storage/app/public
             s3: amazon Drive
             custom: define by us*/
            $request->merge([
                'image_path' => $filename,
            ]);
        }

        $course->update($request->all());
        return redirect()->route('dashboard')->with('success', "$course->name Updated Successfully");
    }

    public function changeStatus($id)
    {
        if (!$id)
            abort(404);

        $course = Course::find($id);
        if ($course->status == 'active') {
            $course->status = 'disabled';
            $course->save();
        } elseif ($course->status == 'disabled') {
            $course->status = 'active';
            $course->save();
        }
        return redirect()->back();
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


        return redirect()->route('courses.index')->with('success', "$course->name Deleted Successfully");
    }
}
