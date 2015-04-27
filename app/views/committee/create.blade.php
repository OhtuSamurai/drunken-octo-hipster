@extends('layouts.master')

@section('pagehead')
  {{HTML::script('javascript/pooli.js')}}
@stop

@section('content')
  <h1>Uuden toimikunnan luominen</h1>

	{{ Form::open(array('action' => 'committee.store')) }}
	{{ Form::label('name', 'Valitse toimikunnalle nimi' )}}
	{{ Form::text('name') }}
	<br>
	{{ Form::label('time', 'Kirjoita kokoontumisaika' )}}
	{{ Form::text('time') }}
	<br>
	{{ Form::label('time', 'Valitse laitos' )}}
	{{ Form::select('department', array('Fysiikan laitos' => 'Fysiikan laitos', 'Matematiikan ja tilastotieteen laitos' => 'Matematiikan ja tilastotieteen laitos', 'Tietojenkäsittelytieteen laitos' => 'Tietojenkäsittelytieteen laitos', 'Geotieteiden ja maantieteen laitos' => 'Geotieteiden ja maantieteen laitos', 'Kemian laitos' => 'Kemian laitos')); }}
	<br>
	{{ Form::label('role', 'Valitse täytettävän tehtävän nimike' )}}
	{{ Form::select('role', array('Professori' => 'Professori', 'Lehtori' => 'Lehtori', 'Apulaisprofessori' => 'Apulaisprofessori', 'Dosentti' => 'Dosentti', 'Yliopisto-opettaja' => 'Yliopisto-opettaja')); }}
	<br>
	{{ Form::label('time', 'Valitse toimikuntaan tulevat poolilaiset listasta' )}}
	@include('user.list')
	{{ Form::submit('Luo uusi toimikunta', array('class' => 'btn btn-primary')) }}

	
	{{ Form::close() }}

@stop
