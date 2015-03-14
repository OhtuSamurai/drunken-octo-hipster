@extends('layouts.master')

@section('content')
  <h1>Toimikunnat</h1>

	@include('committee.list')

@if(Auth::user() && Auth::user()->is_admin)
	<div class ="row">
		<div class="col-md-6">
  			<a href="/poll/create" class="btn btn-primary" role="button">Luo uusi toimikunta kyselyn kautta</a>
		</div>
		<div class="col-md-6">
  <a href="/committee/create" class="btn btn-primary" role="button">Luo uusi toimikunta ilman kyselyä</a>
		</div>
	</div>
@endif

@stop
