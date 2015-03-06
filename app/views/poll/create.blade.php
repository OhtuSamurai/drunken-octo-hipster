@extends('layouts.master')

@section('pagehead')
  {{HTML::script('javascript/pooli.js')}}
@stop

@section('content')
  <h1>Uuden kyselyn luonti</h1>

	@if(Auth::user() && Auth::user()->is_admin)
		{{ Form::open(array('action' => 'poll.store')) }}
		{{ Form::label('toimikunta', 'Valitse toimikunnalle nimi' )}}
		{{ Form::text('toimikunta') }}
		{{ Form::submit('Luo uusi kysely', array('class' => 'btn btn-primary')) }}
	@endif

	@include('user._form')
	{{ Form::close() }}

@stop
