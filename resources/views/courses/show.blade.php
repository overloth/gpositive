@extends('layouts.app')


@section('content')
	
	<p> <a href="/courses">All Courses</a></p>
	<p> Selected course: {{$course->title}} </p>
	<p> Description: {{$course->description}} </p>

	List of videos (articles) goes here: 
	@foreach ($course->articles as $article)
		<a href="/articles/{{$article->id}}">{{$article->title}}</a>
		by <a href="/authors/{{$article->author->id}}">{{$article->author->name}}</a>
		@if($loop->remaining != 0) 
		- {{-- put dash between videos, but not after last one --}}
		@endif
	@endforeach
@stop