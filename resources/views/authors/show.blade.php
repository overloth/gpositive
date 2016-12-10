@extends('layouts.app')


@section('content')
	
	<p> <a href="/authors">All Authors</a></p>
	<p> Selected author: {{$author->name}} </p>
	<p> Title: {{$author->title}} </p>
	<p> Biography: {{$author->biography}} </p>

	<p>List of videos (articles) goes here: </p>
	@foreach ($author->articles as $article)
		<a href="/articles/{{$article->id}}">{{$article->title}}</a> 
		@if ($article->course)
		(<a href="/courses/{{$article->course->id}}">{{$article->course->title}}</a>)
		@endif
		@if($loop->remaining != 0) 
		- {{-- put dash between videos, but not after last one --}}
		@endif
	@endforeach

<br><br><br>
	<p>All comments by this author:</p>
	@foreach ($author->user->comments as $comment)
		<p>On article <a href="/articles/{{$comment->article->id}}">{{$comment->article->title}}</a>: {{$comment->text}}</p>
	@endforeach

@stop