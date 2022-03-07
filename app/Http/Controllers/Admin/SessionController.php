<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Session;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if(! $id )
            abort(404);

        $course_id = $id;
        $course_name = Course::find($id)->name;
        
        $session = new Session();
        return view('admin.sessions.createSession',compact('session','course_id','course_name'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate(Session::validateRules());    
        
        $request->merge([
            'slug' => Str::slug($request->name),
        ]);
        Session::create($request->all());

        return redirect(route('courses.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(! $id )
            abort(404);
        
        $course_name = Course::find($id)->name;
        $sessions = Session::all()->where('course_id', $id);
        
        
        return view('admin.sessions.index',compact('sessions','course_name'));
            
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $session = Session::findOrFail($id);
        // withTrashed()  used for including soft deleted items 
        // onlyTrashed()  find just deleted items
        return view('admin.sessions.editSession',[
            'session' => $session,
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
        // dd($request);
        $session = Session::findOrFail($id);
        $request->validate(Session::validateRules());
        
        //here we will handle the file to store it in a place
        $url = $request->input('url');
        $session->update($request->all());
        return redirect($url)->with('success',"$session->name Updated Successfully");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $session = Session::findOrFail($id);
        $session->delete();

        
        return back()->with('success',"$session->name Updated Successfully");
       

    }
}
