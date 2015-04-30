@extends('layouts.master')
@section('pagehead')
  {{HTML::script('javascript/inactive.js')}}
  {{HTML::script('javascript/sortusers.js')}}
@stop
@section('content')

<div class="col-md-7">
	<h1>Poolin ulkopuoliset käyttäjät</h1>
	<a href="{{URL::to('/user/create')}}" class="btn btn-primary" role="button">Luo uusi käyttäjä</a>
	{{ Form::open(array('action' => array('UserController@addToPool'), 'id'=>'MoveorRemove', 'method'=>'PUT')) }}		
		@include('user.list')
		{{ Form::submit('Siirrä käyttäjä pooliin', array('class' => 'btn btn-primary', 'id'=>'moveuser')) }}
		{{ Form::submit('Poista käyttäjä järjestelmästä', array('class' => 'btn btn-primary', 'id'=>'deleteuser')) }}
	{{ Form::close() }}	
</div>

@stop
