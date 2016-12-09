
@extends('layouts.app')

@section('content')
	
	<h1> All courses </h1>

	<p><a href="/courses/create"> [Add New Course] </a></p>
	<br>

	@foreach ($courses as $course)

	<p>Title: <a href="/courses/{{$course->id}}">{{$course->title}} [${{$course->price}}]</a></p>
	<p>Description: {{$course->description}}</p>
		
	{{ Form::open(array('url' => URL::to('/courses/' . $course->id . '/edit'), 'method' => 'GET', 'style'=>'display:inline-block')) }}
    <button type="submit" >Edit</button>
	{{ Form::close() }}

	{{ Form::open(array('url' => URL::to('/courses/' . $course->id), 'method' => 'DELETE', 'style'=>'display:inline-block')) }}
    <button type="submit" >Delete</button>
	{{ Form::close() }}
	
	<br>
	<br>
	<br>

	@endforeach

@stop