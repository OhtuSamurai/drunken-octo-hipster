@extends('layouts.master')

@section('content')
  <h1>Meneillään olevat kyselyt</h1>

	@include('poll.list')

@if(Auth::user() && Auth::user()->is_admin)
  <p><a href="/poll/create" class="btn btn-default" role="button">Luo uusi kysely</a></p>
@endif

@stop
