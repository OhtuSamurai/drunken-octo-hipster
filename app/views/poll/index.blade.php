@extends('layouts.master')

@section('content')
  <h1>Meneillään olevat kyselyt</h1>

	@include('poll.list')

  <p><a href="/poll/create" class="btn btn-default" role="button">Luo uusi kysely</a></p>
@stop
