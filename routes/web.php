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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'HomeController@index');

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

Route::get('events', function () {
    return view('events');
});



Route::post('upload/image', function(Request $request) {
    $file = $request->file('file');
    $filename = $file->getClientOriginalName();
    $file->move('uploads/', $filename);
    return '/uploads/' . $filename;
});
