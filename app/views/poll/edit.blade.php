@extends('layouts.master')

@section('pagehead')
  {{HTML::script('javascript/pooli.js')}}
@stop

@section('content')
	<h1>Muokkaa kyselyä {{$poll->toimikunta}}</h1>

	{{ Form::open(array('action' => array('PollController@update', $poll->id), 'id'=>'titleanddes', 'method' => 'PUT')) }}
	<div class="row col-md-7 top15">
	{{ Form::text('toimikunta', $poll->toimikunta,array('placeholder'=>'Otsikko')) }}
	</div>
	<div class="row col-md-7 top15">
	{{ Form::textarea('description', $poll->description,array('placeholder'=>'Kuvaus','size'=>'40x3'))}}
	</div>

	<table class="pooltable table table-hover">
	  <thead>
		<tr>
		  <th>Etunimi</th>
		  <th>Sukunimi</th>
		  <th>Sähköposti</th>
		  <th>Laitos</th>
		  <th>Asema</th>
		</tr>
	  </thead>
	  <tbody>
	  @foreach($users as $user)
			
			@if($poll->users->contains($user))
		<tr data-userid="{{$user->id}}" class="active" >
		  <td><a href="/user/{{$user->id}}">{{$user->first_name}}</a><input class="userselector hidden" type="checkbox" name="user[]" value="{{$user->id}}" checked></td>
			@else
		<tr data-userid="{{$user->id}}" >
		  <td><a href="/user/{{$user->id}}">{{$user->first_name}}</a><input class="userselector hidden" type="checkbox" name="user[]" value="{{$user->id}}"></td>
			@endif
		  <td>{{$user->last_name}}</td>
		  <td>{{$user->email}}</td>
		  <td>{{$user->department}}</td>
		  <td>{{$user->position}}</td>
		</tr>

	  @endforeach
	  </tbody>
	</table>

	<div class="row col-md-7 top7">
	{{ Form::submit('Tallenna',array('class'=>'btn btn-default'))}}
	</div>

	{{ Form::close() }}

	<div class="row top30">
	<div class="col-md-6">
		@include('lurker.list')
		@include('lurker.create')
	</div>
	<div class="col-md-6">
		@include('timeidea.list')
		@include('timeidea.create-form')
	</div>
	</div>
	<div class="row col-md-7 top30">	
	<a class='btn btn-primary' role='button' href={{action('PollController@show', ['id' => $poll->id])}}>Palaa kyselyyn</a>
	</div>
@stop
