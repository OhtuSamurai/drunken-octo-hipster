@extends('layouts.master')

@section('content')
  <h1>Sisäänkirjautuminen</h1>


  	@if(Auth::user())
  	{{{Auth::user()->first_name}}}
  	@endif

	{{ Form::open(/* array('action' => 'LoginController@doLogin')*/) }}

	{{ Form::label('username', 'Käyttäjätunnus' )}}
	{{ Form::text('username') }}

	{{ Form::submit('Kirjaudu', array('class' => 'btn btn-primary')) }}

	{{ Form::close()}}
@stop
