@extends('layouts.app')
@section('content')

<div class="w3-content" style="max-width:1400px">
	
        @foreach ($comments as $comment)
			<div>{{$comment->user->name}}: {{$comment->text}}<br><button>Edit</button> <button>Delete</button></div>
	    @endforeach
        
</div>


@stop


     