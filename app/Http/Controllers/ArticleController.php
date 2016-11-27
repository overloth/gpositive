<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //echo 'articless';
        $articles = Article::all();

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // TODO: check if admin logged in
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->author = 'Gorana Rakic-Bajic';
        //$request->input('author') = 'Gorana Rakic-Bajic';

        $inss = $request->all();
        //dd($inss);
        $inss['author'] = 'Gorana Rakic-Bajic';
        $inss['comments'] = '';
        $article = Article::create($inss);
    
        $article->author = 'Gorana Rakic-Bajic';

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
                $article->image = $destinationPath . '/' . $filename;
                //save
                $article->save();

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


        return redirect('articles');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
