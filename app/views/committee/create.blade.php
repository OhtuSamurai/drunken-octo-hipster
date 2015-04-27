@extends('layouts.master')

@section('pagehead')
  {{HTML::script('javascript/pooli.js')}}
@stop

@section('content')
  <h1>Uuden toimikunnan luominen</h1>

	{{ Form::open(array('action' => 'committee.store')) }}
	{{ Form::label('name', 'Valitse toimikunnalle nimi' )}}
	{{ Form::text('name') }}
	{{ Form::label('time', 'Kirjoita kokoontumisaika' )}}
	{{ Form::text('time') }}
	{{ Form::label('time', 'Valitse laitos' )}}
	{{ Form::select('department', array('Fysiikan laitos' => 'Fysiikan laitos', 'Matematiikan ja tilastotieteen laitos' => 'Matematiikan ja tilastotieteen laitos', 'Tietojenkäsittelytieteen laitos' => 'Tietojenkäsittelytieteen laitos', 'Geotieteiden ja maantieteen laitos' => 'Geotieteiden ja maantieteen laitos', 'Kemian laitos' => 'Kemian laitos')); }}
	{{ Form::submit('Luo uusi toimikunta', array('class' => 'btn btn-primary')) }}

	@include('user.list')
	{{ Form::close() }}

@stop
