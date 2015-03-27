@extends('layouts.master')

@section('content')
	<h1>Muokkaa kyselyä {{$poll->toimikunta}}</h1>

	{{ Form::open(array('action' => 'PollController@updateDescriptionAndTitle', 'id'=>'titleanddes', 'method' => 'PUT')) }}
	{{ Form::hidden('poll_id', $poll->id) }}
	<div>
  	@if(Auth::user() && Auth::user()->is_admin)
  		<p>Otsikko  {{ Form::text('title', $poll->toimikunta) }} </p>
  		<p>Kuvaus  {{ Form::textarea('description', $poll->description)}}
  			<input type="submit" value="Tallenna">
  		</p>
	@endif  
	</div>
	{{ Form::close() }}
@stop