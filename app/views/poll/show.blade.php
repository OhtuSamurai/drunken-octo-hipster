@extends('layouts.master')

@if($poll->is_open)
@section('pagehead')
  {{HTML::script('javascript/poll_timeidea.js')}}
@stop
@endif

@section('content')
<h1>Sopivat ajat opetustaitotoimikunnan {{$poll->toimikunta}} tapaamiseen</h1>
{{ Form::open(array('action' => 'AnswerController@updateSopivuus', 'id'=>'pollform', 'method' => 'PUT')) }} {{-- , 'method'=>'GET' Here starts form for answers --}}
<table class="table table-bordered">
	<thead>
		<tr>
			<th class="col-md-1">
				{{--<a type="button" class="btn btn-default btn-block" aria-label="Muokkaa" href="/timeidea/create">
  					<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
				</a>--}}
			</th>
			@if (!empty($users))
			@foreach($users as $user)
				<td class="col-md-1 users" data-id = "{{$user->id}}">
					{{$user->position . ":"}}
					{{$user->first_name}}
					{{$user->last_name . ","}}
					{{$user->department}}
				</td>
			@endforeach
			@endif
			<td class="col-md-1">
				Paras/Sopii/Ei sovi
			</td>
		</tr>
	</thead>
	<tbody>
		@foreach($timeideas as $timeidea)
			@include('timeidea.show')		
		@endforeach
		<th></th>
		@foreach($users as $user)
			<td class="allred" data-userid="{{$user->id}}">kaikki punaiseksi</td>
		@endforeach
	</tbody>
</table>
<div class="row">
@if($poll->is_open)
<div class="col-md-3">
	{{ Form::hidden('poll_id', $poll->id) }}
	{{ Form::submit('Tallenna vastaukset', array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
</div>
@endif
<div class="col-md-2 col-md-offset-7">
	<table class="table table-bordered selitykset">
		<tbody>
			<tr>
				<td class="eisovi"><b>ei sovi</b></td>
				<td class="sopii"><b>sopii</b></td>
				<td class="parhaiten"><b>paras</b></td>		
			</tr>
		</tbody>
	</table>
</div>
</div>
@include('comment.list')		
@if(Auth::user() && Auth::user()->is_admin)
	<div class="admin top30">
	<h2> Admin-alue </h2>
	<div class="row">
		@include('timeidea.create-form')
	</div>
    @include('poll.close')
	{{ Form::open(array('action' => array('PollController@update', $poll->id), 'id'=>'committeeform', 'method'=>'PUT')) }}
	{{ Form::hidden('time', '', array('class' => 'valittuaika')) }}
	<div class = "valitutuserit hidden">
		@foreach($users as $user)
			{{ Form::checkbox('user[]', $user->id) }}
		@endforeach
	</div>
	{{ Form::hidden('is_open', 0)}}
	{{-- {{ Form::hidden('poll_id', $poll->id)}} --}}
	<div class="row top15">
		{{ Form::submit('Sulje kysely', array('class' => 'btn btn-primary')) }}
	</div>
	{{ Form::close() }}
	</div>
@endif

@stop
