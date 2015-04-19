@extends('layouts.master')
@section('content')

<div class="col-md-7">

@if(Auth::user() && Auth::user()->is_admin)
	<div class ="row">
		<div class="top7">
  			<a href="/poll/create" class="btn btn-primary" role="button">Luo uusi toimikunta kyselyn kautta</a>
		</div>
		<div class="top7">
  <a href="/committee/create" class="btn btn-primary" role="button">Luo uusi toimikunta ilman kyselyä</a>
		</div>
	</div>
@endif

  <h1>Avoimet toimikunnat</h1>
	@include('committee.list')

	{{ob_start();$committees=$closed;ob_end_clean()}}
	<h1>Suljetut toimikunnat</h2>
	@include('committee.list')
</div>
@stop
