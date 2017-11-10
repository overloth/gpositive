@extends('layouts.app')

@section('content')
<!-- w3-content defines a container for fixed size centered content,
and is wrapped around the whole page content, except for the footer in this example -->
<div class="w3-content" style="max-width:1400px;display:block;background-attachment: fixed;background-size:cover; width:100%;background-position:fixed;">

<!-- Header -->
<header class="w3-container w3-center w3-padding-32" >
    <b><h1 class="{{ Request::is('positive') ? 'active' : '' }}"><h1 class="djek" style="font-family: 'Gloria Hallelujah', cursive; padding-bottom: 10px;" =>@lang('various.name')</h1></h1></b>
  <p style="font-family: 'Gloria Hallelujah', cursive;"> @lang('various.positive') </p>
</header>

<!-- About Card on medium screens -->
<div class="w3-hide-large w3-hide-small w3-margin-top w3-margin-bottom">
    <div class="w3-container w3-white w3-padding-32">
    <img src="https://s3.us-east-2.amazonaws.com/gpositive/uploads/Positive.jpg" alt="Me" style="width:150px" class="w3-left w3-round-large w3-margin-right">
    <h4><b>Pozitivna psihologija</b></h4>
    <span>Pozitivna psihologija je naučna disciplina nastala u drugoj polovini 20. veka kao izraz potrebe psihologa da se fokus sa proučavanja patoloških mentalnih stanja i faktora rizika mentalnog zdravlja preorijentiše na proučavanje mogućnosti unapređenja mentalnog zdravlja i faktore koji utiču na podsticanje psihološkog blagostanja.
Tokom godina istraživanja, iz brojnih teorijskih modela psihološkog blagostanja o kojima detaljnije možete pročitati  OVDE (tu će biti link do članka Teorijski modeli psihološkog blagostanja koji ću jednog dana, a nadamo se to pre napisati) izrasli su različiti programi/seminari/treninzi/radionice usmereni na unapređivanje psihološkog blagostanja.</span>
    <p><a href="/authors/1">Pogledaj textove</a>
  </div>
</div>

<!-- About Card on small screens -->
<div class="w3-hide-large w3-hide-medium w3-margin-top w3-margin-bottom">
  <img src="https://s3.us-east-2.amazonaws.com/gpositive/uploads/Positive.jpg" style="width:100%" alt="Me">
  <div class="w3-container w3-white">
    <h4><b>Pozitivna psihologija</b></h4>
    <p>Pozitivna psihologija je naučna disciplina nastala u drugoj polovini 20. veka kao izraz potrebe psihologa da se fokus sa proučavanja patoloških mentalnih stanja i faktora rizika mentalnog zdravlja preorijentiše na proučavanje mogućnosti unapređenja mentalnog zdravlja i faktore koji utiču na podsticanje psihološkog blagostanja.
Tokom godina istraživanja, iz brojnih teorijskih modela psihološkog blagostanja o kojima detaljnije možete pročitati  OVDE (tu će biti link do članka Teorijski modeli psihološkog blagostanja koji ću jednog dana, a nadamo se to pre napisati) izrasli su različiti programi/seminari/treninzi/radionice usmereni na unapređivanje psihološkog blagostanja.</p>
    <p><a href="/authors/1">Pogledaj textove</a>
  </div>
</div>

<!-- Grid -->
<div class="w3-row">

<!-- Blog entries -->
<div class="w3-col l8 s12">

@if(count($articles) === 0)

  <div class="w3-card-4 w3-margin w3-white">
  <img src="/images/woods.jpg" alt="Norway" style="width:100%">
    <div class="w3-container w3-padding-8">
      <h3><b>NEDOSTATAK TEKSTOVA</b></h3>
      <h5>Malo objasnjenje, <span class="w3-opacity">Avgust 18 2017</span></h5>
    </div>

    <div class="w3-container">
      <p>Autori textova su usled nedostatka ispiracije i velike nervoze uzeli pauzu kako bi pronashli savrshen kapucino. Ne brinite chim ga pronadju, nestace nervoza i vratice im se inspiracija. Samim tim bice i textova!  </p>
      <div class="w3-row">
        
        
      </div>
    </div>
  </div>
    

  @else




  @foreach ($articles as $article)

  <!-- Blog entry -->
  <div class="w3-card-4 w3-margin w3-white">

    <div class="article_image" style="background:url('{{$article->image}}') no-repeat; background-size:cover; width:100%; background-position: 0px -50px; height:270px;"> </div>
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
          <p><span class="w3-padding-large w3-right"><b>Comments</b> <span class="w3-tag">{{App\Comment::where('article_id', $article->id)->count()}}</span></span></p>
        </div> 
      </div>
    </div>
  </div>
  <hr>
 
  @endforeach
  @endif

  <!-- Blog entry -->

<!--<div class="w3-card-4 w3-margin w3-white">
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
  </div> -->

<!-- END BLOG ENTRIES -->
</div>

<!-- Introduction menu -->
<div class="w3-col l4 w3-hide-medium w3-hide-small">
  <!-- About Card -->
  <div class="w3-card-2 w3-margin w3-margin-top">
  <img src="https://s3.us-east-2.amazonaws.com/gpositive/uploads/Positive.jpg" style="width:100%">
    <div class="w3-container w3-white">
      <div class="w3-container w3-white">
      <h4><b>Pozitivna psihologija</b></h4>
      <p>Pozitivna psihologija je naučna disciplina nastala u drugoj polovini 20. veka kao izraz potrebe psihologa da se fokus sa proučavanja patoloških mentalnih stanja i faktora rizika mentalnog zdravlja preorijentiše na proučavanje mogućnosti unapređenja mentalnog zdravlja i faktore koji utiču na podsticanje psihološkog blagostanja.
Tokom godina istraživanja, iz brojnih teorijskih modela psihološkog blagostanja o kojima detaljnije možete pročitati  OVDE (tu će biti link do članka Teorijski modeli psihološkog blagostanja koji ću jednog dana, a nadamo se to pre napisati) izrasli su različiti programi/seminari/treninzi/radionice usmereni na unapređivanje <a href="/articles/331">psihološkog blagostanja</a>.</p>
    </div>
   <!--   <p><a href="/authors/1">Pogledaj textove</a></p> -->
    </div>
  </div><hr>
  
  <!-- Posts -->
  <div class="w3-card-2 w3-margin">
    <div class="w3-container w3-padding" >
      <h4>Kursevi</h4>
    </div>
    <ul class="w3-ul w3-hoverable w3-white">

    @if(count($courses) === 0)
    <li class="w3-padding-16">
        <img src="/images/sad.png" alt="Image" class="w3-left w3-margin-right" style="width:50px">
        <span class="w3-large">Trenutno nemamo nijedan kurs organizovan!</span><br>
        
      </li>

  @else

    
      
    @foreach ($courses as $course)
    @if(count($course->articles) != 0)
    
      <li class="w3-padding-16">
        <img src="{{$course->image}}" alt="Image" class="w3-left w3-margin-right" style="width:75px;height: 50px;">
        <a href="/courses/{{$course->id}}"><span class="w3-large">{{$course->title}}</span></a><br>
        <p>{{$course->description}}</p>
      </li>

      @else
      <li class="w3-padding-16">
        <img src="{{$course->image}}" alt="Image" class="w3-left w3-margin-right" style="width:75px;height: 50px;">
        <a href="/courses/{{$course->id}}"><span class="w3-large">{{$course->title}}</span></a><br>
        <p>Kurs je u pripremi!</p>
      </li>

      @endif
    @endforeach
    
     
    @endif


<!--
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

      -->

    </ul>
  </div>
  <hr>

  <div class="w3-card-2 w3-margin">
    <div class="w3-container w3-padding" >
      <h4>Radionice</h4>
    </div>
    <ul class="w3-ul w3-hoverable w3-white">

      @if(count($workshops) === 0)
      <li class="w3-padding-16">
        <img src="/images/sad.png" alt="Image" class="w3-left w3-margin-right" style="width:50px">
        <span class="w3-large">Trenutno nemamo nijednu radionicu organizovanu!</span><br>
        
      </li>

      @else


      
      @foreach ($workshops as $workshop)
      
      <li class="w3-padding-16">
        <img src="{{$workshop->image}}" alt="Image" class="w3-left w3-margin-right" style="width:75px;height: 50px;">
        <a href="/workshops/{{$workshop->id}}"><span class="w3-large">{{$workshop->title}}</span></a><br>
        <p>{{$workshop->description}}</p>
      </li>

      

     
      @endforeach


      @endif

      </ul>
  </div>
  <hr>
 
  <!-- Labels / tags -->
  <div class="w3-card-2 w3-margin">
    <div class="w3-container w3-padding"  ">
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
