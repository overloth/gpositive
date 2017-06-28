<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Course;
use App\Tag;
use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Comment;
use Carbon\Carbon;
use App\Workshop;
class WorkshopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $workshops = Workshop::latest('updated_at')->get();

        return view('workshops.index', compact('workshops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //not logged in, no editing articles
        if(!Auth::user())
        {
            dd('there was problem saying you are not logged in');
            return;
        }

        // check if author logged in
        if(!Auth::user()->author)
        {
            dd('there was problem saying you are not author');
            return;
        }
        
        

        return view('workshops.create', compact('workshops'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        if(!Auth::user())
        {
            dd('there was problem saying you are not logged in');
            return;
        }

        if(!Auth::user()->author)
        {
            dd('there was problem saying you are not author');
            return;
        }

        $inss = $request->all();
        //dd($inss);
        //$user = Auth::user()->author->id;
        $inss['author_id'] = Auth::user()->author->id;
        //$inss['course_id'] = 0;
        $workshop = Workshop::create($inss);

        
    
        //$article->author = 'Gorana Rakic-Bajic';

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
                $workshop->image = $destinationPath . '/' . $filename;
                //save
                $workshop->save();

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


        return redirect('workshops');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //find article by id
        $workshop = Workshop::findOrFail($id);
        return view('workshops.show', compact('workshop'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //not logged in, no editing articles
        if(!Auth::user())
        {
            dd('there was problem saying you are not logged in');
            return;
        }

        //check if user is author
        if(!Auth::user()->author)
        {
            dd('there was problem saying you are not author');
            return;
        }

        $workshop = Workshop::findOrFail($id);

        //check if author is editing his article
        if(Auth::user()->author->id != $workshop->author_id)
        {
            dd('there was problem saying you are not author of this article');
            return;
        }

        
        return view('workshops.edit', compact('workshop'));
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
       //not logged in, no updating articles
        if(!Auth::user())
        {
            dd('there was problem saying you are not logged in');
            return;
        }

        //check if user is author
        if(!Auth::user()->author)
        {
            dd('there was problem saying you are not author');
            return;
        }

        //find specified article
        $workshop = Workshop::findOrFail($id);

        //check if author is editing his article
        if(Auth::user()->author->id != $workshop->author_id)
        {
            dd('there was problem saying you are not author of this article');
            return;
        }
        
        

        // and update it
        $workshop->update($request->all());

        
         if ($request->hasFile('image'))
         {  
            $destinationPath = 'uploads';
            $image = $request->file('image');
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString()); 
            $filename = $timestamp. '-' .$image->getClientOriginalName();
            $workshop->image = $filename;
            //uploading file to given path
            $request->file('image')->move($destinationPath, $filename);
            //set item image
            $workshop->image = $destinationPath . '/' . $filename; 
             //save
            $workshop->save();
            //$article->update($request->all());
 
            //$article->tags()->sync($request->input('tag_list'));

            //return redirect('articles');
            
            //dd ('slika uspesno upload-ovana');
            //return;
            //return '/uploads/' . $filename;
            //return redirect('articles');                  
        }   

        return redirect('workshops');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       //not logged in, no updating articles
        if(!Auth::user())
        {
            dd('there was problem saying you are not logged in');
            return;
        }

        //check if user is author
        if(!Auth::user()->author)
        {
            dd('there was problem saying you are not author');
            return;
        }

        //find specified article
        $workshop = Workshop::findOrFail($id);

        //check if author is editing his article
        if(Auth::user()->author->id != $workshop->author_id)
        {
            dd('there was problem saying you are not author of this article');
            return;
        }

        $workshop->delete();
        
        return redirect('workshops');
    
    }
}
