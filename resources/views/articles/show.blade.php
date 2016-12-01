@extends('layouts.app')


@section('content')
	
	<p> <a href="/articles"><-Back</a></p>
	<p> Selected article: {{$article->title}} </p>
	<p> Description: {{$article->description}} </p>
	<p><img src="/{{$article->image}}" width="600px" alt="ASD"></p>
	<p>ge?</p>
<font> ojo moj aaaaaaaaaaaaaaaaaaaaaaaaaaa o </font>
	{!! $article->body !!}
	<p>ge?</p>
@stop