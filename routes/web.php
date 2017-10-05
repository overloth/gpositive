<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use Illuminate\Http\Request;
use Illuminate\Http\Input;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Log;

/*Route::get('/', function () {
    return view('welcome');
});*/

//dd($_COOKIE['lang']);
//Log::info('Showing web: ' . session('lang'));

//if($_COOKIE['lang']) App::setLocale($_COOKIE['lang']);

Route::get('/', 'HomeController@index')->name('home');
Route::get('/language/{locale}', 'HomeController@setLanguage');

Auth::routes();

Route::resource('articles','ArticleController');

Route::resource('courses','CourseController');

Route::resource('authors','AuthorController');

Route::resource('comments','CommentController');

Route::resource('tags','TagController');

//Route::get('/home', 'HomeController@index');

/*Route::get('courses', function () {
    return view('courses');
});*/

//Route::get('events', function () {
//    return view('events');
//});

Route::get('/events','EventController@events');
Route::resource('workshops','WorkshopController');



Route::post('upload/image', function(Request $request) {
    $file = $request->file('file');
    $filename = $file->getClientOriginalName();
    $file->move('uploads/', $filename);
    return '/uploads/' . $filename;
});




Route::get('auth/google', 'Auth\LoginController@redirectToProvider');
Route::get('auth/google/callback', 'Auth\loginController@handleProviderCallback');

Route::get('/redirect/{service2}', 'SocialAuthController@redirect');
Route::get('/callback/{service2}', 'SocialAuthController@callback');
