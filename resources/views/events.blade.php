@extends('layouts.app')

@section('content')
<!-- w3-content defines a container for fixed size centered content,
and is wrapped around the whole page content, except for the footer in this example -->
<div class="w3-content" style="max-width:1400px;background:url('/images/grass2.jpg') no-repeat;display:block;margin-left:auto;margin-right:auto;background-size:cover; width:100%; min-height:1200px;background-position: fixed;">
    <br><h3 style="text-align: center; margin-top: 0px;color: white;"><b>RADIONICA BASTA</b></h3>
		<div class="w3-col l4 w3-hide-medium w3-hide-small" style="float:right;">
		  <!-- About Card -->
		    <div class="w3-card-2 w3-margin w3-margin-top">
		  	<img src="/images/radionica_basta.jpg" style="width:100%;height: 330px;">
		    	<div class="w3-container w3-white">
				      <h4><b>RADIONICA BASTA</b></h4>
				      <p>mesto za text :)</p>
		    	</div>
		    </div><hr>
		  <!-- About Card -->
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
	        </div>
	       </div>
	     </a>
  @endforeach

<!-- END w3-content -->
</div>







@endsection
