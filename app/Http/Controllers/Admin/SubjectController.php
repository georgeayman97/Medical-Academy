<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects  = Subject::all();
        return view('admin.subjects.index',['subjects' => $subjects]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function active()
    {
        $subjects  = Subject::query()->where('status',Subject::STATUS_ACTIVE)->get();
        return view('admin.subjects.index',['subjects' => $subjects]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function disabled()
    {
        $subjects  = Subject::query()->where('status',Subject::STATUS_DISABLED)->get();
        return view('admin.subjects.index',['subjects' => $subjects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subject = new Subject();

        $faculties = Faculty::all();
        return view('admin.subjects.create',compact('subject','faculties'));
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

        if($request->hasFile('image')){
            $file = $request->file('image'); // upload file opject
            // $file->getClientOriginalName(); // returns file name
            $filename= date('YmdHi').$file->getClientOriginalName();
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
        else
        {
            $request->merge([
                'image_path' => "none",
            ]);
        }
        $request->merge([
            'slug' => Str::slug($request->name),
        ]);
        Subject::create($request->all());
        return redirect(route('subjects.index'));
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
        $subject = Subject::findOrFail($id);
        $faculties = Faculty::all();

        return view('admin.subjects.editSubject',[
            'subject' => $subject,
            'faculties' => $faculties
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
        $subject = Subject::findOrFail($id);
        $request->validate(Subject::validateRules());

        if($request->hasFile('image')){
            $file = $request->file('image'); // upload file opject
            // $file->getClientOriginalName(); // returns file name
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);

             $request->merge([
                'image_path' => $filename,
            ]);
        }

        $subject->update($request->all());
        return redirect()->route('dashboard')->with('success',"$subject->name Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function changeStatus($id)
    {
        if (!$id)
            abort(404);

        $subject = Subject::find($id);
        if ($subject->status == 'active') {
            $subject->status = 'disabled';
            $subject->save();
        } elseif ($subject->status == 'disabled') {
            $subject->status = 'active';
            $subject->save();
        }
        return redirect()->back();
    }
    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        // delete image from uploads disk
        Storage::disk('uploads')->delete($subject->image_path);
        return redirect()->route('subjects.index')->with('success',"$subject->name Deleted Successfully");
    }
}
