@extends('layouts.master')

@section('content')
<h1>{{$user->first_name}} {{$user->last_name}}</h1>

<p>Käyttäjätunnus: {{$user->username}}</p>
<p>Laitos: {{$user->department}}</p>
<p>Asema: {{$user->position}}</p>

<p>Kuvaus:</p>
<pre>{{$user->description}}</pre>

<a href="/user/{{$user->id}}/edit" class="btn btn-primary" role="button">Muokkaa tietoja</a>

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
