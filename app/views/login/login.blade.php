@extends('layouts.master')

@section('content')
  <h1>Sisäänkirjautuminen</h1>

	{{ Form::open(array('id' => 'loginForm')) }}

	{{ Form::label('username', 'Käyttäjätunnus' )}}
	{{ Form::text('username') }}

	{{ Form::submit('Kirjaudu', array('class' => 'btn btn-default')) }}

	{{ Form::close()}}
@stop
