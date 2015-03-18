@extends('layouts.master')

@section('content')
<div class="col-md-7">
  <h1>Käyttäjän tietojen muokkaus</h1>

  	{{ Form::open(array('action' => array('UserController@update', $user->id), 'method'=>'PUT', 'class' => 'form-horizontal')) }}

	<div class="form-group">
	{{ Form::label('first_name', 'Etunimi', array('class' => 'control-label col-sm-2'))}}
	<div class="col-sm-10">
	{{ Form::text('first_name', $user->first_name) }}
	</div>
	</div>
	<div class="form-group">
	{{ Form::label('last_name', 'Sukunimi', array('class' => 'control-label col-sm-2'))}}
	<div class="col-sm-10">
	{{ Form::text('last_name', $user->last_name) }}
	</div>
	</div>
	<div class="form-group">
	{{ Form::label('department', 'Laitos', array('class' => 'control-label col-sm-2'))}}
	<div class="col-sm-10">
	{{ Form::text('department', $user->department) }}
	</div>
	</div>
	<div class="form-group">
	{{ Form::label('position', 'Asema', array('class' => 'control-label col-sm-2'))}}
	<div class="col-sm-10">
	{{ Form::text('position', $user->position) }}
	</div>
	</div>
	<div class="form-group">
	{{ Form::label('description', 'Kuvaus', array('class' => 'control-label col-sm-2'))}}
	<div class="col-sm-10">
	{{ Form::textarea('description', $user->description) }}
	</div>
	</div>
	{{ Form::submit('Tallenna muutokset', array('class' => 'btn btn-primary')) }}

	{{ Form::close()}}
</div>
@stop
