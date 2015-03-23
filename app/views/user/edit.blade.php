@extends('layouts.master')

@section('content')
<div class="col-md-7">
  <h1>Käyttäjän tietojen muokkaus</h1>
	{{ $create = false }}
	{{ Form::open(array('action' => array('UserController@update', $user->id), 'method'=>'PUT', 'class' => 'form-horizontal')) }}
	@include('user.form')
	{{ Form::submit('Tallenna muutokset', array('class' => 'btn btn-primary')) }}

	{{ Form::close()}}
</div>
@stop
