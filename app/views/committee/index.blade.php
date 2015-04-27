@extends('layouts.master')
@section('content')

@if(Auth::user() && Auth::user()->is_admin)
	<div class ="row">
  		<a href="/poll/create" class="btn btn-primary" role="button">Luo uusi toimikunta kyselyn kautta</a>
		<a href="/committee/create" class="btn btn-primary" role="button">Luo uusi toimikunta ilman kyselyä</a>
	</div>
@endif

	<div class="row">
		<div class="col-md-4">
			<h1>Avoimet toimikunnat</h1>
			@include('committee.list')
		</div>
		<div class="col-md-1">
		{{ob_start();$committees=$closed;ob_end_clean()}}
		</div>
		<div class="col-md-4">
		<h1>Suljetut toimikunnat</h2>
		@include('committee.list')
		</div>
	</div>
@stop
