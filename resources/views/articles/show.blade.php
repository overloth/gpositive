@extends('layouts.app')


@section('content')
<div class="w3-content" style="max-width:1400px">
  <div class="w3-card-4 w3-margin w3-white ">
    <div class="article_image" style="background:url('{{$article->image}}') no-repeat;display:block;margin-left:auto;margin-right:auto;background-size:cover; width:100%; background-position: 0px -50px; height:500px;"></div>
    <div class="w3-container w3-padding-8">
      @if ($article->course)
        <h4><b><a style="color:black;" href="/courses/{{$article->course->id}}">{{$article->course->title}}</a></b></h4>
      @endif
        <h3 class="article_heading"><b>{{$article->title}}</b></h3>
        <p><a href="/authors/{{$article->author->id}}">{{$article->author->name}}</a><span class="w3-opacity" style="float:right;padding-right:25px;">{{ date('d M Y ', $article->created_at->timestamp) }}</span></p>
         <h5 style="font-style: italic;">{{$article->description}}</h5>
    </div>

    <div class="w3-container">
      <div style="height:auto; width:100%; overflow:auto;">
        {!! $article->body !!}
      </div>
      @if ($article->tags)
        <p>Tags:
        @foreach ($article->tags as $tag)
        <a href="/tags/{{$tag->id}}" class="w3-tag w3-black w3-margin-bottom">{{$tag->name}}</a>  
        @endforeach
        </p>
      @endif
      <hr>
      <div class="w3-row">
        <div class="w3-col m8 s12">
          <p>Comments:</p>
          
            @foreach ($article->comments as $comment)
             

              {{ Form::open(array('url' => URL::to('/comments/' . $comment->id), 'method' => 'DELETE', 'style'=>'display:inline-block')) }}

              
           <div class="form-group">
          
           
              
                 <p>{{$comment->user->name}}: {{$comment->text}} <strong>{{$comment->created_at->diffForHumans()}}</strong>
            <button type="submit" class="btn btn-default pull-right">
              <i class="fa fa-btn fa-trash-o" px;"></i>
            </button></p>
          
        </div>
           {{ Form::close() }}



            @endforeach
          
          <!-- <div class="w3-col m4 w3-hide-small">
            <p>
            <span class="w3-padding-large w3-right"><b>Comments</b>
              <span class="w3-tag">{{App\Comment::where('article_id', $article->id)->count()}}</span>
            </span>
            </p>
          </div> -->
        </div>
      </div>
  
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
          <div class="col-md-6 col-md-offset-6 w3-padding-large">
            <button type="submit" class="btn btn-primary">
              <i class="fa fa-btn fa-shield" px;"></i> Submit Comment
            </button>
          </div>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

<hr>
    
@stop