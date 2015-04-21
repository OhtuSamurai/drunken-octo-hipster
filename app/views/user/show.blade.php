@extends('layouts.master')

@section('content')
<div class="row">
<div class="col-md-3">
<h1>{{$user->first_name}} {{$user->last_name}}</h1>

<p>Käyttäjätunnus: {{$user->username}}</p>
<p>Sähköpostiosoite: {{$user->email}}</p>
<p>Laitos: {{$user->department}}</p>
<p>Asema: {{$user->position}}</p>

<p>Kuulut tällä hetkellä {{$curr}} toimikuntaan ja {{$currp}} kyselyyn.</p>
<p>Olet ollut jäsenenä {{$evry}} toimikunnassa {{$evryp}} kyselyssä.</p>
<p>Kuvaus:</p>
<pre>{{$user->description}}</pre>
@if (Auth::user() && (Auth::user()->is_admin || Auth::user()->id==$user->id))
<a href="/user/{{$user->id}}/edit" class="btn btn-primary" role="button">Muokkaa tietoja</a>
@endif
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

@if($user->is_admin && Auth::user() && Auth::user()->is_admin)
<div class="col-md-4">
  <h2>Päätetyt toimikunnat:</h2>
	@include('committee.list')
</div>
<div class="col-md-4">
  <h2>Avoimet kyselyt:</h2>
	@include('poll.list')
</div>
@elseif (Auth::user() && ($user->id==Auth::user()->id || Auth::user()->is_admin))
<div class="col-md-4">
  <h2>Kuulut toimikuntiin:</h2>
	@include('committee.list')
</div>
<div class="col-md-4">
  <h2>Kuulut kyselyihin:</h2>
	@include('poll.list')
</div>
@endif
</div>


</div>
@stop

