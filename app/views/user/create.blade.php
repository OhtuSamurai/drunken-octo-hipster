@extends('layouts.master')

@section('content')
<div class="col-md-7">
  <h1>Uuden käyttäjän luonti</h1>

  	{{ Form::open(array('action' => 'user.store', 'class' => 'form-horizontal')) }}

  	<div class="form-group">
	{{ Form::label('username', 'Käyttäjätunnus', array('class' => 'control-label col-sm-2'))}}
	<div class="col-sm-10">
	{{ Form::text('username', $user->username) }}
	</div>
	</div>
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
	{{ Form::submit('Luo käyttäjä', array('class' => 'btn btn-primary')) }}

	{{ Form::close()}}
</div>
@stop
