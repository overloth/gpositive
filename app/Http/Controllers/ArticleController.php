<?php


namespace App\Http\Controllers;

require('./../vendor/autoload.php');

use Illuminate\Http\Request;
use App\Article;
use App\Course;
use App\Tag;
use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Comment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\Filesystem;
use App\Http\Controllers\File;


use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::latest('updated_at')->get();

        return view('articles.index', compact('articles'));
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
        
        $tags = Tag::pluck('name', 'id');
        $courses = [0 => 'None'] + DB::table('courses')->pluck('title','id')->toArray();

        return view('articles.create', compact('courses', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$request->author = 'Gorana Rakic-Bajic';
        //$request->input('author') = 'Gorana Rakic-Bajic';

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
        $article = Article::create($inss);

        //dd($request->input('tag_list'));
        $article->tags()->attach($request->input('tag_list'));
    
        //$article->author = 'Gorana Rakic-Bajic';

        if ($request->hasFile('image')) {

            if ($request->file('image')->isValid()) {

                $file = $request->file('image');
                
                //set upload path
               // $destinationPath = 'uploads';
                //get filename
                $filename = $request->file('image')->getClientOriginalName();
                $uniqFilename = md5($filename);
                $extension = File::extension($filename);
                $newName = $uniqFilename.$extension;
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
                //dd($filename);

                //set item image
                $article->image = 'https://s3.us-east-2.amazonaws.com/gpositive/' . $keyname;
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
        //find article by id
        $article = Article::findOrFail($id);
        return view('articles.show', compact('article'));
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

        $article = Article::findOrFail($id);

        //check if author is editing his article
        if(Auth::user()->author->id != $article->author_id)
        {
            dd('there was problem saying you are not author of this article');
            return;
        }

        $tags = Tag::pluck('name', 'id')->toArray();
        $courses = [0 => 'None'] + DB::table('courses')->pluck('title','id')->toArray();

        return view('articles.edit', compact('article', 'courses', 'tags'));
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
        $article = Article::findOrFail($id);

        //check if author is editing his article
        if(Auth::user()->author->id != $article->author_id)
        {
            dd('there was problem saying you are not author of this article');
            return;
        }
        
        

        // and update it
        $article->update($request->all());

        $article->tags()->sync($request->input('tag_list'));

         if ($request->hasFile('image'))
         {  
            $destinationPath = 'uploads';
            $image = $request->file('image');
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString()); 
            $filename = $timestamp. '-' .$image->getClientOriginalName();
            $article->image = $filename;
            //uploading file to given path
            $request->file('image')->move($destinationPath, $filename);
            //set item image
            $article->image = $destinationPath . '/' . $filename; 
             //save
            $article->save();
            //$article->update($request->all());
 
            //$article->tags()->sync($request->input('tag_list'));

            //return redirect('articles');
            
            //dd ('slika uspesno upload-ovana');
            //return;
            //return '/uploads/' . $filename;
            //return redirect('articles');                  
        }   

 
        

      







        return redirect('articles');
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
        $article = Article::findOrFail($id);

        //check if author is editing his article
        if(Auth::user()->author->id != $article->author_id)
        {
            dd('there was problem saying you are not author of this article');
            return;
        }

        $article->delete();
        
        return redirect('articles');
    }
}