@extends('layouts.master')

@section('pagehead')
  {{HTML::script('javascript/pooli.js')}}
@stop

@section('content')
  <h1>Uuden toimikunnan luominen</h1>

	@if(Auth::user() && Auth::user()->is_admin)
		{{ Form::open(array('action' => 'committee.store')) }}
		{{ Form::label('name', 'Valitse toimikunnalle nimi' )}}
		{{ Form::text('name') }}
		{{ Form::label('time', 'Kirjoita kokoontumisaika' )}}
		{{ Form::text('time') }}
		{{ Form::submit('Luo uusi toimikunta', array('class' => 'btn btn-primary')) }}
	@endif

	@include('user._form')
	{{ Form::close() }}

@stop
