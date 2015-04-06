@extends('layouts.master')
@section('pagehead')
  {{HTML::script('javascript/pooli.js')}}
@stop
@section('content')
{{ Form::open(array('action' => array('UserController@removeFromPool'), 'id'=>'poolremoverform', 'method'=>'PUT')) }}
	<div class="col-md-7">
	
  		<h1>Opetustaitotoimikuntapooli</h1>
  		@include('user.list') 		
		@if(Auth::user() && Auth::user()->is_admin)
  		{{ Form::submit('Poista käyttäjä poolista', array('class' => 'btn btn-primary')) }}
		@endif
  		
	</div>
{{ Form::close() }}
@stop
