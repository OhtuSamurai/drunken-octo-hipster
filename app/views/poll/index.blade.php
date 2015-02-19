@extends('layouts.master')

@section('content')
  <h1>Meneillään olevat kyselyt</h1>

	@include('poll.list')

  <p><a href="#" class="btn btn-default" role="button">Luo uusi toimikunta</a></p>
@stop
