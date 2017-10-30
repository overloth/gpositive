<?php

namespace App\Http\Controllers;

require('./../vendor/autoload.php');

use Illuminate\Http\Request;
use App\Course;
use App;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Article;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\Filesystem;

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

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
        $articles = Article::all();

        return view('courses.index', compact('courses','articles'));
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

                $file = $request->file('image');
                
                //set upload path
               // $destinationPath = 'uploads';
                //get filename
                $filename = $request->file('image')->getClientOriginalName();
                $uniqFilename = md5($filename . time());
                $extension = \File::extension($filename);
                $newName = $uniqFilename . '.' . $extension;
                //uploading file to given path
               //Storage::disk('s3')->put('uploads/' . $filename, file_get_contents($file), 'public');
               // $destinationPath = Storage::disk('s3')->url($filename)
                // set up s3
                $bucket = getenv('S3_BUCKET');
                $keyname = 'uploads/'.$newName;
                $s3 = S3Client::factory([
                    'version' => '2006-03-01',
                    'region' => 'us-east-2'
                ]);
    
                // try
                
                    // Upload data.
                    $s3->putObject(array(
                        'Bucket' => $bucket,
                        'Key'    => $keyname,
                        'Body'   => fopen($_FILES['image']['tmp_name'], 'rb'),
                        'ACL'    => 'public-read'
                    ));
    
                
               

              //  $request->file('image')->move($destinationPath, $filename);
               

                //set item image
                $course->image = 'https://s3.us-east-2.amazonaws.com/' . $bucket . '/' . $keyname;
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

        if ($request->hasFile('image'))
         {  
            $destinationPath = 'uploads';
            $image = $request->file('image');
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString()); 
            $filename = $timestamp. '-' .$image->getClientOriginalName();
            $course->image = $filename;
            //uploading file to given path
            $request->file('image')->move($destinationPath, $filename);
            //set item image
            $course->image = $destinationPath . '/' . $filename; 
             //save
            $course->save();
            //$article->update($request->all());
 
            //$article->tags()->sync($request->input('tag_list'));

            //return redirect('articles');
            
            //dd ('slika uspesno upload-ovana');
            //return;
            //return '/uploads/' . $filename;
            //return redirect('articles');                  
        }   


        
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
