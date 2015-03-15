@extends('layouts.master')

@section('content')
<h1>Yhteenveto</h1>

<div class="col-md-4">
  <h2>Päätetyt toimikunnat:</h2>
	@include('committee.list')
</div>
<div class="col-md-4">
  <h2>Avoimet kyselyt:</h2>
	@include('poll.list')
</div>
@stop
