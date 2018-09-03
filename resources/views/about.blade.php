@extends('layouts.app')

@section('content')
    
    <div class="article_image" style="background:url('{{$about->image}}') no-repeat;display:block;margin-left:auto;margin-right:auto;background-size:cover; width:100%; background-position: 0px -50px; height:500px;"></div>
    <div class="w3-container w3-padding-8">
        <h3 class="article_heading"><b>{{$about->title}}</b></h3>
        <h5 style="font-style: italic;">{{$about->description}}</h5>
    </div>

    <div class="w3-container">
      <div style="height:auto; width:100%; overflow:auto;">
        {!! $about->body !!}
      </div>
    </div>

@endsection
