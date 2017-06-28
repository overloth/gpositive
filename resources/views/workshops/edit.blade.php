@extends('layouts.app')


@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Edit: {{$workshop->title}}</div>
        <div class="panel-body">
                {!! Form::model($workshop, array('url' => URL::to('/workshops/' . $workshop->id), 'class'=>'form-horizontal', 'method' => 'PUT', 'files' => true)) !!}
                @include('workshops.partials.form')
                {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@stop