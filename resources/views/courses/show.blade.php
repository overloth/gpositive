@extends('layouts.app')


@section('content')
	
	<p> <a href="/courses"><-Back</a></p>
	<p> Selected course: {{$course->title}} </p>
	<p> Description: {{$course->description}} </p>

	List of videos (articles) goes here: 
	@foreach ($course->articles as $article)
		{{$article->title}}
		@if($loop->remaining != 0) 
		- {{-- put dash between videos, but not after last one --}}
		@endif
	@endforeach
@stop