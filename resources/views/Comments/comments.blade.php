@extends('layouts.app')
@section('content')

<div class="w3-content" style="max-width:1400px">
	
        @foreach ($comments as $comment)
			<div>{{$comment->user->name}}: {{$comment->text}}<br><button type="submit" class="btn btn-primary">
              <i class="fa fa-btn fa-pencil-square-o" px;"></i> 
            </button><button type="submit" class="btn btn-primary">
              <i class="fa fa-btn fa-trash-o" px;"></i> 
            </button></div>
	    @endforeach
        
</div>


@stop


     