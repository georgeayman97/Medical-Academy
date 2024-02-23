<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Session;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($id)
    {
        if(! $id )
            abort(404);

        $course_id = $id;
        $course = Course::find($id);

        $session = new Session();
        return view('admin.sessions.createSession',compact('session','course_id','course'));
    }

    public function changeStatus($id)
    {
        if(! $id )
            abort(404);

        $session = Session::find($id);
        if($session->status == 'active'){
            $session->status = 'disabled';
            $session->save();
        }elseif($session->status == 'disabled'){
            $session->status = 'active';
            $session->save();
        }
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request): Application|RedirectResponse|Redirector
    {

        $request->validate(Session::validateRules());
        $request->merge([
            'slug' => Str::slug($request->name),
        ]);

        $session = Session::create($request->except('pdf'));
        if($request->hasFile('pdf')){
            $path = date('YmdHi').$request->file('pdf')->getClientOriginalName();
            $request->pdf->move(public_path('pdf'), $path);
            $session->update(['pdf'=>$path]);
        }
        return redirect(route('sessions.show',['session'=>$request->course_id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        if(! $id )
            abort(404);

        $sortColumn = request('sort', 'order');
        $sortDirection = request('direction', 'asc');

        // Build the query with filters and ordering
        $query = Session::query()
            ->filter(request()->except(['page', 'sort', 'direction']))
            ->orderBy($sortColumn, $sortDirection);

        // Get the paginated users
        $sessions = $query->where('course_id', $id)
            ->orderByDesc('order')
            ->get();

        // Append the sort column and direction to the pagination links
        // $sessions->appends(['sort' => $sortColumn, 'direction' => $sortDirection]);

        $course = Course::find($id);


        return view('admin.sessions.index',compact('sessions','course','sortDirection','sortColumn'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
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
     * @param Request $request
     * @param  int  $id
     * @return Application|Redirector|RedirectResponse
     */
    public function update(Request $request, $id): Application|RedirectResponse|Redirector
    {
        // dd($request);
        $session = Session::findOrFail($id);
        $request->validate(Session::validateRules($session));

        //here we will handle the file to store it in a place
//        $url = $request->input('url');
        $session->update($request->all());
//        return redirect($url)->with('success',"$session->name Updated Successfully");
        return redirect(route('sessions.show',['session'=>$request->course_id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $session = Session::findOrFail($id);
        $session->delete();


        return back()->with('success',"$session->name Updated Successfully");


    }
}
