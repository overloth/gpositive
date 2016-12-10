@extends('layouts.app')


@section('content')
	
	<p> <a href="/articles"><-Back</a></p>
	<p> Selected article: {{$article->title}} </p>
	<p>Author: <a href="/authors/{{$article->author->id}}">{{$article->author->name}}</a></p>
	@if ($article->course)
	<p>Course: <a href="/courses/{{$article->course->id}}">{{$article->course->title}}</a></p>
	@endif
	<p> Description: {{$article->description}} </p>
	<p><img src="/{{$article->image}}" width="600px" alt="ASD"></p>
	{!! $article->body !!}

	<p>Comments:</p>
	@foreach ($article->comments as $comment)
		<p>{{$comment->user->name}}: {{$comment->text}}</p>
	@endforeach

	{!! Form::open(array('url' => URL::to('/comments'), 'method' => 'post', 'class'=>'form-horizontal', 'files' => true)) !!}

		{!! Form::hidden('article_id', $article->id) !!}

		{{--New Comment--}}
		<div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">

			<label for="text" class="col-md-4 control-label">Join Discussion</label>

			<div class="col-md-6">
			    {!! Form::text('text', null, array('class' => 'form-control', 'placeholder'=> 'Enter comment here..')) !!}

			    @if ($errors->has('text'))
			        <span class="help-block">
			            <strong>{{ $errors->first('text') }}</strong>
			        </span>
			    @endif
			</div>
		</div>

		<div class="form-group">
		    <div class="col-md-6 col-md-offset-4">
		        <button type="submit" class="btn btn-primary">
		            <i class="fa fa-btn fa-shield"></i> Submit Comment
		        </button>
		    </div>
		</div>

	{!! Form::close() !!}

@stop