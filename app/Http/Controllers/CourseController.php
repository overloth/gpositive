<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $courses = Course::all();

        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // check if admin logged in
        if(!Auth::user() || (Auth::user()->id != 1 && Auth::user()->id != 2))
        {
            dd('there was problem saying you are not admin');
            return;
        }
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // check if admin logged in
        if(!Auth::user() || (Auth::user()->id != 1 && Auth::user()->id != 2))
        {
            dd('there was problem saying you are not admin');
            return;
        }

        $inss = $request->all();
        //dd($inss);

        $course = Course::create($inss);


        if ($request->hasFile('image')) {

            if ($request->file('image')->isValid()) {
                
                //set upload path
                $destinationPath = 'uploads';
                //get filename
                $filename = $request->file('image')->getClientOriginalName();
                //uploading file to given path
                $request->file('image')->move($destinationPath, $filename);
                //dd($filename);
                //set item image
                $course->image = $destinationPath . '/' . $filename;
                //save
                $course->save();

            }
            else
            {
                //there was problem uploading image
                dd('there was problem uploading image');
            }

            

        }
        else
        {
            //image file not uploaded
            dd('image file not uploaded');
        }



    
        return redirect('courses');
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
        $course = Course::findOrFail($id);
        return view('courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // check if admin logged in
        if(!Auth::user() || (Auth::user()->id != 1 && Auth::user()->id != 2))
        {
            dd('there was problem saying you are not admin');
            return;
        }

        $course = Course::findOrFail($id);
        return view('courses.edit', compact('course'));
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
        // check if admin logged in
        if(!Auth::user() || (Auth::user()->id != 1 && Auth::user()->id != 2))
        {
            dd('there was problem saying you are not admin');
            return;
        }

        //find specified course and update it
        $course = Course::findOrFail($id);
        $course->update($request->all());
        
        return redirect('courses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // check if admin logged in
        if(!Auth::user() || (Auth::user()->id != 1 && Auth::user()->id != 2))
        {
            dd('there was problem saying you are not admin');
            return;
        }

        $course = Course::findOrFail($id);

        $course->delete();
        
        return redirect('courses');
    }
}
