@extends('layouts.master')

@section('content')
  <h1>Toimikunnat</h1>

	@include('committee.list')

  <p><a href="/committee/create" class="btn btn-default" role="button">Luo uusi toimikunta</a></p>
@stop
