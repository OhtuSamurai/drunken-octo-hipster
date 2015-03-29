@extends('layouts.master')
@section('content')

<div class="col-md-7">
  <h1>Toimikunnat</h1>

	@include('committee.list')

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
</div>
@stop
