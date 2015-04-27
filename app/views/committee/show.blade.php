@extends('layouts.master')

@section('content')
<div class="col-md-7">
	<h1>{{ $committee->name }}</h1>
	<h2>Järjestetään: {{ $committee->time }}</h2>
	<h2>Tehtävän nimike: {{ $committee->role }}</h2>
	<h2>{{ $committee->department }}</h2>	
	
  @if($committee->description)
    <pre>{{ $committee->description }}</pre>
  @endif
</div>
<div class="row col-md-7">
	@if(Auth::user() && Auth::user()->is_admin)
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
    <a class='btn btn-primary' href={{action('CommitteeController@edit', ['id' => $committee->id])}} role='button'>Muokkaa toimikuntaa</a>
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

</div>
<div class="col-md-2">
  @include('comment.list')
</div>
</div>
	<div class="col-md-7">	
	@if (Auth::user() && ($showFiles||Auth::user()->is_admin))
		@include('attachment.list')
	@endif
	</div>
  <div class="col-md-12">
	@if (Auth::user() && Auth::user()->is_admin) 
    @include('attachment.form')
	@endif
  </div>
@stop
