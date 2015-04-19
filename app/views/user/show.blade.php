@extends('layouts.master')

@section('content')

<h1>{{$user->first_name}} {{$user->last_name}}</h1>

<p>Käyttäjätunnus: {{$user->username}}</p>
<p>Sähköpostiosoite: {{$user->email}}</p>
<p>Laitos: {{$user->department}}</p>
<p>Asema: {{$user->position}}</p>

<p>Kuulut tällä hetkellä {{$curr}} toimikuntaan ja {{$currp}} kyselyyn.</p>
<p>Olet ollut jäsenenä {{$evry}} toimikunnassa {{$evryp}} kyselyssä.</p>
<p>Kuvaus:</p>
<pre>{{$user->description}}</pre>
<div class="col-md-4">
<a href="/user/{{$user->id}}/edit" class="btn btn-primary" role="button">Muokkaa tietoja</a>
</div>
<div class="row">
@if(Auth::user()->is_admin && Auth::user()->id != $user->id)
	@if($user->is_admin)
    {{ Form::open(array('action' => array('UserController@update', $user->id), 'method' => 'PUT')) }}
    {{ Form::hidden('is_admin', 0) }}
    {{ Form::submit('Poista Admin oikeudet', array('class' => 'btn btn-danger')) }}
    {{ Form::close() }}
    @else
    {{ Form::open(array('action' => array('UserController@update', $user->id), 'method' => 'PUT')) }}
    {{ Form::hidden('is_admin', 1) }}
    {{ Form::submit('Anna Admin oikeudet', array('class' => 'btn btn-danger')) }}
    {{ Form::close() }}
    @endif
@endif
</div>

<div class="row">
<h1>Yhteenveto</h1>

@if($user->is_admin)
<div class="col-md-4">
  <h2>Päätetyt toimikunnat:</h2>
	@include('committee.list')
</div>
<div class="col-md-4">
  <h2>Avoimet kyselyt:</h2>
	@include('poll.list')
</div>
@else
<div class="col-md-4">
  <h2>Kuulut toimikuntiin:</h2>
	@include('committee.list')
</div>
<div class="col-md-12">
  <h2>Kuulut kyselyihin:</h2>
	@include('poll.list')
</div>
@endif
</div>
@stop
