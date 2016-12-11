@extends('layouts.app')


@section('content')
	
	<h2> All articles with tag: {{$tag->name}}</h2>
	
	@foreach ($articles as $article)
		<a href="/articles/{{$article->id}}">{{$article->title}}</a>
		by <a href="/authors/{{$article->author->id}}">{{$article->author->name}}</a>
		@if($loop->remaining != 0) 
		<br> {{-- put dash between videos, but not after last one --}}
		@endif
	@endforeach
@stop