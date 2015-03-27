@extends('layouts.master')
@section('pagehead')
  {{HTML::script('javascript/inactive.js')}}
@stop
@section('content')

<div class="col-md-7">
	<h1>Poolin ulkopuoliset käyttäjät</h1>
	<a href="/user/create" class="btn btn-primary" role="button">Luo uusi käyttäjä</a>
	{{ Form::open(array('action' => array('UserController@addToPool'), 'id'=>'poolremoverform', 'method'=>'PUT')) }}		
		@include('user.list')
		{{ Form::submit('Siirrä käyttäjä pooliin', array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}	
</div>

@stop
