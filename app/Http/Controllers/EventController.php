<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App;
use App\Article;
use App\Course;
use App\Tag;
use App\Comment;
use App\Workshop;

class EventController extends Controller
{
    public function events(Request $request)
    {
        //dd($request);
        
        Log::info('Showing indexx: ' . session('lang'));

        $articles = Article::latest('updated_at')->get();
        $courses = Course::latest('updated_at')->get();
        $tags = Tag::all();
        $workshops = Workshop::latest('updated_at')->get();
        

        //if($request->cookie('lang')) App::setLocale($request->cookie('lang'));

        return view('events', compact('articles', 'courses', 'tags','workshops'));
    }




}
