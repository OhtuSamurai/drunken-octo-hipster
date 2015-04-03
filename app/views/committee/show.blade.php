@extends('layouts.master')

@section('content')
<div class="col-md-7">
	<h1>{{ $committee->name }}</h1>
	<h2>Järjestetään: {{ $committee->time }}</h2>
    @if($committee->is_open)
    {{ Form::open(array('url' => '/committee/'.$committee->id.'/toggleopen')) }}
    {{ Form::submit('Sulje toimikunta', array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}
    @else
    Toimikunta on suljettu.
    {{ Form::open(array('url' => '/committee/'.$committee->id.'/toggleopen')) }}
    {{ Form::submit('Avaa uudelleen', array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}
    @endif

    <table class="pooltable table table-hover">
  	<thead>
    	<tr>
      	<th>Etunimi</th>
      	<th>Sukunimi</th>
      	<th>Laitos</th>
      	<th>Asema</th>
    	</tr>
  	</thead>
 	<tbody>
 	@foreach($users as $user)
    <tr data-userid="{{$user->id}}" >
      <td>{{$user->first_name}}</td>
      <td>{{$user->last_name}}</td>
      <td>{{$user->department}}</td>
      <td>{{$user->position}}</td>
    </tr>

  	@endforeach
  	</tbody>
	</table>
	@if (Auth::user() && ($showFiles||Auth::user()->is_admin))
	@include('attachment.list')
	@endif

	@if (Auth::user() && Auth::user()->is_admin)
		@include('attachment.form')
	@endif
</div>
@stop
