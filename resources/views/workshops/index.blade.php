
@extends('layouts.app')

@section('content')
   
    
<div class="w3-content" style="max-width:1400px;background:url('/images/zuticvet.jpg') no-repeat;display:block;background-attachment: fixed;background-size:cover; width:100%;background-position:fixed;">
   
  <div class="w3-row">
    @if (auth()->check())
      @if (auth()->user()->id == 1  || auth()->user()->author)
        <p style="text-align: center;"><b><a href="/workshops/create" style="color:white;"> [Add New Workshop] </a></b></p>
      @endif
    @endif

    <br>
    <div class="w3-col l4 w3-hide-medium w3-hide-small" style="float:left;">
      <div class="w3-card-2 w3-margin w3-margin-top">
      <img src="/images/lale2.jpg" style="width:100%;">
        <div class="w3-container w3-white">
          <h4><b>mesto za text :)</b></h4>
          <p></p>
        </div>
      </div><hr>
      <div class="w3-card-2 w3-margin w3-margin-top">
      <img src="/images/lotus.jpg" style="width:100%">
        <div class="w3-container w3-white">
          <h4><b>mesto za text 2 :)</b></h4>
          <p></p>
        </div>
      </div><hr>
    </div>
  @foreach ($workshops as $workshop)
    <a style="color:black;" href="/workshops/{{$workshop->id}}">
      <div class="w3-col l4 m6 s12 ">
        <div class="w3-card-4 w3-margin w3-white ">
          <div class="article_image" style="background:url('/{{$workshop->image}}') no-repeat;display:block;margin-left:auto;margin-right:auto;background-size:cover; width:100%; background-position: 0px -50px; height:170px;"> </div>
          <div class="w3-container w3-padding-8">
            <h3 class="article_heading"><b><a href="/workshops/{{$workshop->id}}">{{$workshop->title}}</a></b></h3>
            <p><a href="/authors/{{$workshop->author->id}}">{{$workshop->author->name}}</a><span class="w3-opacity" style="float:right;padding-right:25px;">{{ date('d M Y ', $workshop->created_at->timestamp) }}</span></p>
            <h5 style="font-style: italic;">{{$workshop->description}}</h5>
          </div>
            @if (auth()->check())
              @if (auth()->user()->id == 1  || (auth()->user()->author && auth()->user()->author->id == $workshop->author->id))
                <div style="text-align: center;"> 
                  {{ Form::open(array('url' => URL::to('/workshops/' . $workshop->id . '/edit'), 'method' => 'GET', 'style'=>'display:inline-block')) }}
                  <button type="submit" class="btn btn-primary " style="margin-bottom: 10px;"  >Edit</button>
                  {{ Form::close() }}

                  {{ Form::open(array('url' => URL::to('/workshops/' . $workshop->id), 'method' => 'DELETE', 'style'=>'display:inline-block')) }}
                  <button type="submit" class="btn btn-primary " style="margin-bottom: 10px;" >Delete</button>
                  {{ Form::close() }}
                </div>
              @endif
            @endif
          </div>
        </div>
      </a>
  @endforeach  
  </div>  
</div>

@stop