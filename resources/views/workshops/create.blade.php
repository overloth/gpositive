@extends('layouts.app')


@section('content')
    
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Create New Workshop</div>
        <div class="panel-body">

            {!! Form::open(array('url' => URL::to('/workshops'), 'method' => 'post', 'class'=>'form-horizontal', 'files' => true)) !!}

            @include('workshops.partials.form')

            {!! Form::close() !!}

        </div>
      </div>
    </div>
  </div>
</div>

@stop