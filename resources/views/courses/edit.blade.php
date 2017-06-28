@extends('layouts.app')


@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit: {{$course->title}}</div>
                <div class="panel-body">

				{!! Form::model($course, array('url' => URL::to('/courses/' . $course->id), 'class'=>'form-horizontal', 'method' => 'PUT', 'files' => true)) !!}

				@include('courses.partials.form')

				{!! Form::close() !!}

				</div>
			</div>
		</div>
	</div>
</div>
@stop