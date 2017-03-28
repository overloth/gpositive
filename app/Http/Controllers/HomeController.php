<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App;

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
        
        Log::info('Showing index: ' . session('lang'));


        //if($request->cookie('lang')) App::setLocale($request->cookie('lang'));

        return view('home');
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
