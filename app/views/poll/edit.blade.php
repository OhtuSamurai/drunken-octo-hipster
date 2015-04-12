@extends('layouts.master')

@section('content')
	<h1>Muokkaa kyselyä {{$poll->toimikunta}}</h1>

	{{ Form::open(array('action' => array('PollController@update', $poll->id), 'id'=>'titleanddes', 'method' => 'PUT')) }}
  	@if(Auth::user() && Auth::user()->is_admin)
		<div class="row col-md-7 top15">
  		{{ Form::text('toimikunta', $poll->toimikunta,array('placeholder'=>'Otsikko')) }}
		</div>
		<div class="row col-md-7 top15">
  		{{ Form::textarea('description', $poll->description,array('placeholder'=>'Kuvaus','size'=>'40x3'))}}
		</div>
		<div class="row col-md-7 top7">
		{{ Form::submit('Tallenna',array('class'=>'btn btn-default'))}}
		</div>
  	
	@endif  
	{{ Form::close() }}

	<div class="row top30">
	<div class="col-md-6">
		@include('lurker.list')
		@include('lurker.create')
	</div>
	<div class="col-md-6">
		@include('timeidea.list')
		@include('timeidea.create-form')
	</div>
	</div>
	<div class="row col-md-7 top30">	
	<a class='btn btn-primary' role='button' href={{action('PollController@show', ['id' => $poll->id])}}>Palaa kyselyyn</a>
	</div>
@stop
