@extends('layouts.app')
@section('content')
<div class="w3-content" style="max-width:1400px">

  <div class="w3-card-4 w3-margin w3-white ">

    <div class="article_image" style="background:url('{{$workshop->image}}') no-repeat;display:block;margin-left:auto;margin-right:auto;background-size:cover; width:100%; background-position: 0px -50px; height:500px;"> </div>
    <div class="w3-container w3-padding-8">
       
      <h3 class="article_heading"><b>{{$workshop->title}}</b></h3>
      <p><a href="/authors/{{$workshop->author->id}}">{{$workshop->author->name}}</a><span class="w3-opacity" style="float:right;padding-right:25px;">{{ date('d M Y ', $workshop->created_at->timestamp) }}</span></p>
      <h5 style="font-style: italic;">{{$workshop->description}}</h5>
    </div>
    <div class="w3-container">
      <div style="height:100px; width:100%; overflow:hidden;">
        {!! $workshop->body !!}
      </div>
      <hr>
    </div>
</div>
  
  <hr>


    
    
@stop