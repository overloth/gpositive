@extends('layouts.app')

@section ('content')

<div class="col-sm-8 blog-main">

	<div class="comments" >
		<ul class="list-group">

			@foreach ($comments as $comment)
			
			<li class="list-group-item">
				{{$comment->user->name}}: {{$comment->text}} <strong>{{$comment->created_at->diffForHumans()}}</strong>
				{{ Form::open(array('url' => URL::to('/comments/' . $comment->id), 'method' => 'DELETE', 'style'=>'display:inline-block')) }}
           <button type="submit" class="btn btn-default pull-right " style="margin-bottom: 10px;" ><i class="fa fa-btn fa-trash-o" px;"></i></button>
           {{ Form::close() }}
				
			</li>
			@endforeach
		</ul> 
	</div>
</div>
@stop



