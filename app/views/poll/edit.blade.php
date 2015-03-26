@extends('layouts.master')

@section('content')
	<h1>Muokkaa kyselyä {{$poll->toimikunta}}</h1>

	<h4>Lisää kyselyyn järjestelmän ulkopuoleisia henkilöitä</h4>
	@include('lurker.create')
@stop