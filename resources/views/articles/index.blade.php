
@extends('layouts.app')

@section('content')



<div class="w3-content" style="max-width:1400px;display:block;background-attachment: fixed;background-size:cover; width:100%;background-position:fixed;">
 <div class="w3-row">
  @if (auth()->check())
  @if (auth()->user()->id == 1  || auth()->user()->author)
  <p style="text-align: center;"><b><a href="/articles/create" > [Add New Article] </a><b></p>
    @endif
    @endif

    <br>

    @if(count($articles) === 0)

    <div class="w3-card-4 w3-margin w3-white">
      <img src="/images/pisaca.jpg" alt="Norway" style="width:100%">
      <div class="w3-container w3-padding-8">
        <h3><b>NEDOSTATAK TEKSTOVA</b></h3>
        <h5>Malo objasnjenje, <span class="w3-opacity">Avgust 18 2017</span></h5>
      </div>

      <div class="w3-container">
        <p>Autori textova su usled nedostatka ispiracije uzeli pauzu kako bi pronashli savrshen kapucino. Ne brinite chim ga pronadju, vratice im se inspiracija. Samim tim bice i textova!  </p>
        <div class="w3-row">


        </div>
      </div>
    </div>
    

    @else


    @foreach ($articles as $article)
    <a style="color:black;" href="/articles/{{$article->id}}">
      <div class="w3-col l4 m6 s12 ">
        <div class="w3-card-4 w3-margin w3-white ">

          <div class="article_image" style="background:url('{{$article->image}}') no-repeat;display:block;margin-left:auto;margin-right:auto;background-size:cover; width:100%; background-position: 0px -50px; height:170px;"> </div>
          <div class="w3-container w3-padding-8">
           @if ($article->course)
           <h4><b><a style="color:black;" href="/courses/{{$article->course->id}}">{{$article->course->title}}</a></b></h4>
           @endif
           <h3 class="article_heading"><b><a href="/articles/{{$article->id}}">{{$article->title}}</a></b></h3>
           <p><a href="/authors/{{$article->author->id}}">{{$article->author->name}}</a><span class="w3-opacity" style="float:right;padding-right:25px;">{{ date('d M Y ', $article->created_at->timestamp) }}</span></p>
           <h5 style="font-style: italic;">{{$article->description}}</h5>
         </div>

         <div class="w3-container">
          @if ($article->tags)
          <p>Tags:
            @foreach ($article->tags as $tag)
            <a href="/tags/{{$tag->id}}" class="w3-tag w3-black w3-margin-bottom">{{$tag->name}}</a>  
            @endforeach
          </p>
          @endif

        </div>
        @if (auth()->check())
        @if (auth()->user()->id == 41  || (auth()->user()->author && auth()->user()->author->id == $article->author->id))
        <div class="w3-container">

          <p><a href="/comments/{{$article->id}}"><b>Comments  </b> <span class="w3-tag">{{App\Comment::where('article_id', $article->id)->count()}}</span></span></a></p>

          </div>
          


        @endif
        @else
          <div class="w3-container">

          <p><b>Comments  </b> <span class="w3-tag">{{App\Comment::where('article_id', $article->id)->count()}}</span></span></p>

          </div>
        @endif



          @if (auth()->check())
          @if (auth()->user()->id == 41  || (auth()->user()->author && auth()->user()->author->id == $article->author->id))
          <div style="text-align: center;"> 
           {{ Form::open(array('url' => URL::to('/articles/' . $article->id . '/edit'), 'method' => 'GET', 'style'=>'display:inline-block')) }}
           <button type="submit" class="btn btn-primary " style="margin-bottom: 10px;"  >Edit</button>
           {{ Form::close() }}

           {{ Form::open(array('url' => URL::to('/articles/' . $article->id), 'method' => 'DELETE', 'style'=>'display:inline-block')) }}
           <button type="submit" class="btn btn-primary " style="margin-bottom: 10px;" >Delete</button>
           {{ Form::close() }}
         </div>
         @endif
         @endif

       </div>
     </div>
   </a>
   @endforeach
   @endif 
 </div>
</div>
@stop