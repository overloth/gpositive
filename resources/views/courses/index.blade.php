
@extends('layouts.app')

@section('content')
	
	

	

 <div class="w3-content" style="max-width:1400px;background:url('/images/skies.jpg') no-repeat;display:block;margin-left:auto;margin-right:auto;background-size:cover; width:100%; background-position: fixed;">

 @if (auth()->check())
    @if (auth()->user()->id == 1)
  <p style="text-align: center;"><b><a href="/courses/create" style="color: white;"> [Add New Course] </a></b></p>
  @endif
  @endif
  <br>

	@foreach ($courses as $course)
	  <div class="w3-card-4 w3-margin w3-white">
            <a style="color:black;" href="/courses/{{$course->id}}">
                 <div class="course-image" style="background:url('/{{$course->image}}') no-repeat;display:block;margin-left:auto;margin-right:auto;background-size:cover; width:100%; background-position: 0px -50px;"> </div>
            </a>	
	                 <p><a href="/courses/{{$course->id}}">{{$course->title}} [${{$course->price}}]</a></p>
	                 <p>{{$course->description}}</p> 
     
        <div class="w3-row" style="white-space: nowrap; /* important */
        overflow: auto;">
      
      @foreach ($course->articles as $article)
   
      <div class="course-card"> 
       <div class="w3-col l12 m12 s12 ">
          <div class="w3-card-4 w3-margin w3-white" >
            <a style="color:black;" href="/articles/{{$article->id}}">
              <div class="article-image" style="background:url('/{{$article->image}}') no-repeat;display:block;margin-left:auto;margin-right:auto;background-size:cover; width:100%; background-position: 0px -50px;"> </div>
          
                  <h3 class="article_heading_courses" style="padding-left: 10px;padding-top: 5px;" ><b><a href="/articles/{{$article->id}}">{{$article->title}}</a></b><span class="w3-opacity" style="float:right;font-size: 14px;padding-top: 10px;padding-right: 10px;">{{ date('d M Y ', $article->created_at->timestamp) }}</span></h3>
                  <h5 style="font-style: italic;padding-left: 10px;">{{$article->description}}</h5>
                  <h5 style="padding-left: 10px;padding-bottom: 5px;">by: <a href="/authors/{{$article->author->id}}">{{$article->author->name}}</a></h5>
              
              </div>   
            </a>   
          </div>
      </div>
      
      @endforeach
     
    </div>           
</div>

	     @if (auth()->check())
   	      @if (auth()->user()->id == 1)
   	    <div style="text-align: center;">
	         {{ Form::open(array('url' => URL::to('/courses/' . $course->id . '/edit'), 'method' => 'GET', 'style'=>'display:inline-block')) }}
          <button type="submit" >Edit</button>
	         {{ Form::close() }}
	         {{ Form::open(array('url' => URL::to('/courses/' . $course->id), 'method' => 'DELETE', 'style'=>'display:inline-block')) }}
          <button type="submit" >Delete</button>
	         {{ Form::close() }}
	      </div>
	         @endif
	     @endif
	
      <br>
      <br>
      <br>
	@endforeach
</div>
</div>
</div>
  
@stop
