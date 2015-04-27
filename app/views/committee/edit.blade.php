@extends('layouts.master')

@section('content')
	<h1>Muokkaa toimikuntaa {{$committee->name}}</h1>

	{{ Form::open(array('action' => array('CommitteeController@update', $committee->id), 'method' => 'PUT')) }}
  	@if(Auth::check() && Auth::user()->is_admin)
		<div class="row col-md-7 top15">Nimi:
  		{{ Form::text('name', $committee->name) }}
		</div>
		<div class="row col-md-7 top10">Aika:
  		{{ Form::text('time', $committee->time) }}
		</div>
		<div class="row col-md-7 top10">Laitos:
  		{{ Form::select('department', array('Fysiikan laitos' => 'Fysiikan laitos', 'Matematiikan ja tilastotieteen laitos' => 'Matematiikan ja tilastotieteen laitos', 'Tietojenkäsittelytieteen laitos' => 'Tietojenkäsittelytieteen laitos', 'Geotieteiden ja maantieteen laitos' => 'Geotieteiden ja maantieteen laitos', 'Kemian laitos' => 'Kemian laitos'), $committee->department); }}
		</div>
		<div class="row col-md-7 top10">Tehtävän nimike:
  		{{ Form::select('role', array('Professori' => 'Professori', 'Lehtori' => 'Lehtori', 'Apulaisprofessori' => 'Apulaisprofessori', 'Dosentti' => 'Dosentti', 'Yliopisto-opettaja' => 'Yliopisto-opettaja'), $committee->role); }}
		</div>
		<div class="row col-md-7 top5">
  		{{ Form::textarea('description', $committee->description)}}
		</div>
		<div class="row col-md-7 top5">
		{{ Form::submit('Tallenna',array('class'=>'btn btn-default'))}}
		</div>
  	
	@endif  
	{{ Form::close() }}

	<div class="row col-md-7 top30">	
	<a class='btn btn-primary' role='button' href={{action('CommitteeController@show', ['id' => $committee->id])}}>Palaa toimikunnan sivulle</a>
	</div>
@stop
