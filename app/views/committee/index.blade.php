@extends('layouts.master')

@section('content')
  <h1>Toimikunnat</h1>

	@include('committee.list')

  <p><a href="/poll/create" class="btn btn-default" role="button">Luo uusi toimikunta kyselyn kautta</a></p>
  <p><a href="/committee/create" class="btn btn-default" role="button">Luo uusi toimikunta ilman kyselyä</a></p>
@stop
