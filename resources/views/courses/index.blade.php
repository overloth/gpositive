
@extends('layouts.app')

@section('content')
	
	<h1> All courses </h1>

	@if (auth()->check())
   	@if (auth()->user()->id == 1)
	<p><a href="/courses/create"> [Add New Course] </a></p>
	@endif
	@endif

	<br>

	@foreach ($courses as $course)

	<p>Title: <a href="/courses/{{$course->id}}">{{$course->title}} [${{$course->price}}]</a></p>
	<p>Description: {{$course->description}}</p>
	<p>Videos/Articles: 
		@foreach ($course->articles as $article)
			<a href="/articles/{{$article->id}}">{{$article->title}}</a>
			by <a href="/authors/{{$article->author->id}}">{{$article->author->name}}</a>
			@if($loop->remaining != 0)
			- 
			@endif
		@endforeach
	</p>

	@if (auth()->check())
   	@if (auth()->user()->id == 1)
	{{ Form::open(array('url' => URL::to('/courses/' . $course->id . '/edit'), 'method' => 'GET', 'style'=>'display:inline-block')) }}
    <button type="submit" >Edit</button>
	{{ Form::close() }}

	{{ Form::open(array('url' => URL::to('/courses/' . $course->id), 'method' => 'DELETE', 'style'=>'display:inline-block')) }}
    <button type="submit" >Delete</button>
	{{ Form::close() }}
	@endif
	@endif

	<br>
	<br>
	<br>

	@endforeach

@stop