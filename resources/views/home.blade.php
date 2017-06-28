@extends('layouts.app')

@section('content')
<!-- w3-content defines a container for fixed size centered content,
and is wrapped around the whole page content, except for the footer in this example -->
<div class="w3-content" style="max-width:1400px;background:url('/images/zuticvet.jpg') no-repeat;display:block;background-attachment: fixed;background-size:cover; width:100%;background-position:fixed;">

<!-- Header -->
<header class="w3-container w3-center w3-padding-32" >
    <h1 style="font-family: Sans-serif;"><b style="color: white;">CENTAR ZA POZITIVNU PSIHOLOGIJU</b></h1>
  <!-- <p>Welcome to the blog of <span class="w3-tag">unknown</span></p> -->
</header>

<!-- About Card on medium screens -->
<div class="w3-hide-large w3-hide-small w3-margin-top w3-margin-bottom">
    <div class="w3-container w3-white w3-padding-32">
    <img src="/images/avatar_g.jpg" alt="Me" style="width:150px" class="w3-left w3-round-large w3-margin-right">
    <span>Just me, myself and I, exploring the universe of uknownment. I have a heart of love and an interest of lorem ipsum and mauris neque quam blog. I want to share my world with you.</span>
  </div>
</div>

<!-- About Card on small screens -->
<div class="w3-hide-large w3-hide-medium w3-margin-top w3-margin-bottom">
  <img src="/images/avatar_g.jpg" style="width:100%" alt="Me">
  <div class="w3-container w3-white">
    <h4><b>My Name</b></h4>
    <p>Just me, myself and I, exploring the universe of uknownment. I have a heart of love and a interest of lorem ipsum and mauris neque quam blog. I want to share my world with you.</p>
  </div>
</div>

<!-- Grid -->
<div class="w3-row">

<!-- Blog entries -->
<div class="w3-col l8 s12">






  @foreach ($articles as $article)

  <!-- Blog entry -->
  <div class="w3-card-4 w3-margin w3-white">

    <div class="article_image" style="background:url('/{{$article->image}}') no-repeat; background-size:cover; width:100%; background-position: 0px -50px; height:270px;"> </div>
    <div class="w3-container w3-padding-8">
        @if ($article->course)
      <h4><b><a style="color:black;" href="/courses/{{$article->course->id}}">{{$article->course->title}}</a></b></h4>
        @endif
      <h3 class="article_heading"><b><a href="/articles/{{$article->id}}">{{$article->title}}</a></b></h3>
      <p><a href="/authors/{{$article->author->id}}">{{$article->author->name}}</a><span class="w3-opacity" style="float:right;padding-right:25px;">{{ date('d M Y ', $article->created_at->timestamp) }}</span></p>
      <h5 style="font-style: italic;">{{$article->description}}</h5>
    </div>

    <div class="w3-container">
      <div style="height:100px; width:100%; overflow:hidden;">
        {!! $article->body !!}
      </div>
      <div class="w3-row">
        <div class="w3-col m8 s12">
          <p><a href="/articles/{{$article->id}}"><button class="w3-btn w3-padding-large w3-white w3-border w3-hover-border-black"><b>READ MORE »</b></button></a></p>
        </div>
        <div class="w3-col m4 w3-hide-small">
          <p><span class="w3-padding-large w3-right"><b>Comments  </b> <span class="w3-tag">{{App\Comment::where('article_id', $article->id)->count()}}</span></span></p>
        </div> 
      </div>
    </div>
  </div>
  <hr>

  @endforeach

  <!-- Blog entry -->
  <div class="w3-card-4 w3-margin w3-white">
  <img src="/images/bridge.jpg" alt="Norway" style="width:100%">
    <div class="w3-container w3-padding-8">
      <h3><b>BLOG ENTRY</b></h3>
      <h5>Title description, <span class="w3-opacity">April 2, 2014</span></h5>
    </div>

    <div class="w3-container">
      <p>Mauris neque quam, fermentum ut nisl vitae, convallis maximus nisl. Sed mattis nunc id lorem euismod placerat. Vivamus porttitor magna enim, ac accumsan tortor cursus at. Phasellus sed ultricies mi non congue ullam corper. Praesent tincidunt sed
        tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
      <div class="w3-row">
        <div class="w3-col m8 s12">
          <p><button class="w3-btn w3-padding-large w3-white w3-border w3-hover-border-black"><b>READ MORE »</b></button></p>
        </div>
        <div class="w3-col m4 w3-hide-small">
          <p><span class="w3-padding-large w3-right"><b>Comments  </b> <span class="w3-badge">2</span></span></p>
        </div>
      </div>
    </div>
  </div>
<!-- END BLOG ENTRIES -->
</div>

<!-- Introduction menu -->
<div class="w3-col l4 w3-hide-medium w3-hide-small">
  <!-- About Card -->
  <div class="w3-card-2 w3-margin w3-margin-top">
  <img src="/images/radionica_basta.jpg" style="width:100%">
    <div class="w3-container w3-white">
      <h4><b>RADIONICA BASTA</b></h4>
      <p><a href="/events">idi u radionicu</a></p>
    </div>
  </div><hr>
  
  <!-- Posts -->
  <div class="w3-card-2 w3-margin">
    <div class="w3-container w3-padding" style="color:white;">
      <h4>Recent Courses</h4>
    </div>
    <ul class="w3-ul w3-hoverable w3-white">

    @foreach ($courses as $course)

      <li class="w3-padding-16">
        <img src="{{$course->image}}" alt="Image" class="w3-left w3-margin-right" style="width:75px;height: 50px;">
        <a href="/courses/{{$course->id}}"><span class="w3-large">{{$course->title}}</span></a><br>
        <p>{{$course->description}}</p>
      </li>

    @endforeach

      <li class="w3-padding-16">
        <img src="/images/gondol.jpg" alt="Image" class="w3-left w3-margin-right" style="width:50px">
        <span class="w3-large">Ipsum</span><br>
        <span>Praes tinci sed</span>
      </li>

      <li class="w3-padding-16">
        <img src="/images/skies.jpg" alt="Image" class="w3-left w3-margin-right" style="width:50px">
        <span class="w3-large">Dorum</span><br>
        <span>Ultricies congue</span>
      </li>

      <li class="w3-padding-16 w3-hide-medium w3-hide-small">
        <img src="/images/rock.jpg" alt="Image" class="w3-left w3-margin-right" style="width:50px">
        <span class="w3-large">Mingsum</span><br>
        <span>Lorem ipsum dipsum</span>
      </li>

    </ul>
  </div>
  <hr>
 
  <!-- Labels / tags -->
  <div class="w3-card-2 w3-margin">
    <div class="w3-container w3-padding"  style="color:white;">
      <h4>Tags</h4>
    </div>
    <div class="w3-container w3-white" >
    <p> 

  @foreach ($tags as $tag)

    <a href="http://gpositive.app/tags/{{$tag->id}}"><span class="w3-tag w3-black w3-margin-bottom">{{ $tag->name }}</span></a> 

  @endforeach
 
    </p>
    </div>
  </div>
  
<!-- END Introduction Menu -->
</div>

<!-- END GRID -->
</div><br>

<!-- END w3-content -->
</div>







@endsection
