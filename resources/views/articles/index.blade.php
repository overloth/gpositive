
@extends('layouts.app')

@section('content')
	
	<h1> All articles </h1>

	<p><a href="/articles/create"> [Add New Article] </a></p>
	<br>

	@foreach ($articles as $article)

	<p>Title: <a href="/articles/{{$article->id}}">{{$article->title}} [${{$article->price}}]</a></p>
	<p>Author: /{{$article->author}}</p>
	<p>Course: /{{$article->course}}</p>
	<p>Description: {{$article->description}}</p>
	<p>Image: /{{$article->image}}</p>
	<p><img src="/{{$article->image}}" width="200px" alt="ASD"></p>
		
	{{ Form::open(array('url' => URL::to('/articles/' . $article->id . '/edit'), 'method' => 'GET', 'style'=>'display:inline-block')) }}
    <button type="submit" >Edit</button>
	{{ Form::close() }}

	{{ Form::open(array('url' => URL::to('/articles/' . $article->id), 'method' => 'DELETE', 'style'=>'display:inline-block')) }}
    <button type="submit" >Delete</button>
	{{ Form::close() }}
	
	<br>
	<br>
	<br>

	@endforeach

@stop