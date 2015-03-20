@extends('layouts.master')

@section('content')
<div class="col-md-7">
  <h1>Uuden käyttäjän luonti</h1>
  	@if($create=true)@endif {{-- erittäin purkka tapa asettaa muuttuja create trueksi formia varten, jotta formi ei näytä username-kenttää --}}
  	{{ Form::open(array('action' => 'user.store', 'class' => 'form-horizontal')) }}
  	@include('user.form')
	{{ Form::submit('Luo käyttäjä', array('class' => 'btn btn-primary')) }}

	{{ Form::close()}}
</div>
@stop
