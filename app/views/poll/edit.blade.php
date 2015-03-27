@extends('layouts.master')

@section('content')
	<h1>Muokkaa kyselyä {{$poll->toimikunta}}</h1>

	{{ Form::open(array('action' => array('PollController@update', $poll->id), 'id'=>'titleanddes', 'method' => 'PUT')) }}
	<div>
  	@if(Auth::user() && Auth::user()->is_admin)
  		<p>Otsikko  {{ Form::text('title', $poll->toimikunta) }} </p>
  		<p>Kuvaus  {{ Form::textarea('description', $poll->description)}}
  			<input type="submit" value="Tallenna">
  		</p>
	@endif  
	</div>
	{{ Form::close() }}

	<div class="row">
		@include('timeidea.list')
		@include('timeidea.create-form')
	</div>

	<a class='btn btn-primary' role='button' href={{action('PollController@show', ['id' => $poll->id])}}>Siirry kyselyyn</a>
@stop