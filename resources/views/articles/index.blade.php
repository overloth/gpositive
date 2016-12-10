
@extends('layouts.app')

@section('content')
	
	<h1> All articles </h1>

	@if (auth()->check())
   	@if (auth()->user()->id == 2  || auth()->user()->author)
	<p><a href="/articles/create"> [Add New Article] </a></p>
	@endif
	@endif

	<br>

	@foreach ($articles as $article)

	<p>Title: <a href="/articles/{{$article->id}}">{{$article->title}} [${{$article->price}}]</a></p>
	<p>Author: <a href="/authors/{{$article->author->id}}">{{$article->author->name}}</a></p>
	@if ($article->course)
	<p>Course: <a href="/courses/{{$article->course->id}}">{{$article->course->title}}</a></p>
	@endif
	<p>Description: {{$article->description}}</p>
	<p><img src="/{{$article->image}}" width="200px" alt="ASD"></p>

	@if (auth()->check())
   	@if (auth()->user()->id == 2  || (auth()->user()->author && auth()->user()->author->id == $article->author->id))
	{{ Form::open(array('url' => URL::to('/articles/' . $article->id . '/edit'), 'method' => 'GET', 'style'=>'display:inline-block')) }}
    <button type="submit" >Edit</button>
	{{ Form::close() }}

	{{ Form::open(array('url' => URL::to('/articles/' . $article->id), 'method' => 'DELETE', 'style'=>'display:inline-block')) }}
    <button type="submit" >Delete</button>
	{{ Form::close() }}
	@endif
	@endif
	
	<br>
	<br>
	<br>

	@endforeach

@stop