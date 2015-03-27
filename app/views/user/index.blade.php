@extends('layouts.master')
@section('pagehead')
  {{HTML::script('javascript/pooli.js')}}
@stop
@section('content')
{{ Form::open(array('action' => array('UserController@toggleActive'), 'id'=>'poolremoverform', 'method'=>'PUT')) }}
	<div class="col-md-7">
	
  		<h1>Opetustaitotoimikuntapooli</h1>
  		@include('user.list') 		
  		{{ Form::submit('Poista käyttäjä poolista', array('class' => 'btn btn-primary')) }}
  		
	</div>
{{ Form::close() }}
@stop
