<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersEnrolledExport;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseAccess;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CourseAccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $instructors = User::where('role', 'doctor')->get(); // Assuming you have an Instructor model
        $courseYears = Course::distinct('course_year')->pluck('course_year'); // Assuming your courses table has a column named course_year

        $query = CourseAccess::where('status', 'request')->with('course.doctor', 'user');

        if (request()->has('instructor_id') || request()->has('course_year')) {
            $query->whereHas('course', function ($q) {
                if (request('instructor_id') != null) {
                    $q->where('instructor_name', request('instructor_id'));
                }
                if (request('course_year')) {
                    $q->where('course_year', request('course_year'));
                }
            });
        }

        $coursesAccesses = $query->orderByDesc('created_at')->get();

        if (request('id') != null) {
            $coursesAccesses = CourseAccess::all()->where('course_id', request('id'))->where('status', 'request')
                ->sortByDesc('created_at')->load('course', 'user');
        }

        $success = session()->get('success');
        return view('admin.accounts.coursesRequest', [
            'coursesAccesses' => $coursesAccesses,
            'course_id' => request('id') == null ? null : request('id'),
            'status' => 'requests',
            'success' => $success,
            'instructors' => $instructors,
            'courseYears' => $courseYears,
        ]);
    }

    public function indexDeleted()
    {
        $instructors = User::where('role', 'doctor')->get(); // Assuming you have an Instructor model
        $courseYears = Course::distinct('course_year')->pluck('course_year'); // Assuming your courses table has a column named course_year

        $query = CourseAccess::where('status', 'disabled')->with('course.doctor', 'user');

        if (request()->has('instructor_id') || request()->has('course_year')) {
            $query->whereHas('course', function ($q) {
                if (request('instructor_id') != null) {
                    $q->where('instructor_name', request('instructor_id'));
                }
                if (request('course_year')) {
                    $q->where('course_year', request('course_year'));
                }
            });
        }

        $coursesAccesses = $query->orderByDesc('created_at')->get();
        
        if (request('id') != null) {
            $coursesAccesses = CourseAccess::where('course_id', request('id'))->where('status', 'disabled')
                ->with('course', 'user')->get()->sortByDesc('created_at');
        }

        $success = session()->get('success');
        return view('admin.accounts.coursesRequest', [
            'coursesAccesses' => $coursesAccesses,
            'course_id' => request('id') == null ? null : request('id'),
            'status' => 'disabled',
            'success' => $success,
            'instructors' => $instructors,
            'courseYears' => $courseYears,
        ]);
    }

    public function action(Request $request)
    {
        $coursesAccesses = $request->input('coursesAccess');
        $action = $request->input('action');

        if ($action == 'approve') {
            CourseAccess::whereIn('id', $coursesAccesses)->update(['status' => CourseAccess::STATUS_ENROLLED]);
            return redirect()->back()->with('success', 'Selected users marked as Approved!');
        } elseif ($action == 'disable') {
            CourseAccess::whereIn('id', $coursesAccesses)->update(['status' => CourseAccess::STATUS_DISABLED]);
            return redirect()->back()->with('success', 'Selected users marked as Disabled!');
        } elseif ($action == 'delete') {
            CourseAccess::whereIn('id', $coursesAccesses)->delete();
            return redirect()->back()->with('success', 'Selected users marked as Deleted!');
        } else {
            return redirect()->back()->with('error', 'Invalid action!');
        }
    }

    public function approve($id)
    {
        $coureseaccess = CourseAccess::findOrFail($id);
        // dd($coureseaccess);
        if ($coureseaccess) {
            $coureseaccess->status = CourseAccess::STATUS_ENROLLED;
            $coureseaccess->save();
        }
        return back()->with('success', "$coureseaccess->name Activated Successfully");
    }

    public function disable($id)
    {
        $coureseaccess = CourseAccess::findOrFail($id);

        if ($coureseaccess) {
            $coureseaccess->status = CourseAccess::STATUS_DISABLED;
            $coureseaccess->save();
        }
        return back()->with('success', "$coureseaccess->name Disabled Successfully");
    }

    public function export()
    {
        return Excel::download(new UsersEnrolledExport, 'Students.xlsx');
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coureseaccess = CourseAccess::findOrFail($id);
        $coureseaccess->delete();


        return back()->with('success', "$coureseaccess->name Deleted Successfully");
    }
}
