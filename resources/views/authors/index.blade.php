
@extends('layouts.app')

@section('content')
	

	@foreach ($authors as $author)

	<p>Name: <a href="/authors/{{$author->id}}">{{$author->name}}</a></p>
	<p>Title: {{$author->title}}</p>
	<p>Videos/Articles: 
		@foreach ($author->articles as $article)
			<a href="/articles/{{$article->id}}">{{$article->title}}</a>
			@if($loop->remaining != 0)
			- 
			@endif
		@endforeach
	</p>

	<br>
	<br>

	@endforeach

@stop