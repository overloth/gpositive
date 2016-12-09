@extends('layouts.app')


@section('content')
	
	<p> <a href="/courses"><-Back</a></p>
	<p> Selected course: {{$course->title}} </p>
	<p> Description: {{$course->description}} </p>

	List of videos (articles) goes here.
@stop