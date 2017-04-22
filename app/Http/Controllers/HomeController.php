<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App;
use App\Article;
use App\Course;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dd($request);
        
        Log::info('Showing indexx: ' . session('lang'));

        $articles = Article::latest('updated_at')->get();
        $courses = Course::latest('updated_at')->get();

        //if($request->cookie('lang')) App::setLocale($request->cookie('lang'));

        return view('home', compact('articles', 'courses'));
    }

    public function setLanguage(Request $request, $locale = '')
    {
        # code...
        session()->put('lang', $locale);
        $_COOKIE['lang'] = $locale;
        Log::info('Showing contorller set language: ' . session('lang'));

        //dd($locale);
        return redirect()->to('/')->cookie('lang', $locale, 24*60*290);
    }
}
