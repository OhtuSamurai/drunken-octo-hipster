@extends('layouts.master')

@if($poll->is_open)
@section('pagehead')
  {{HTML::script('javascript/poll_timeidea.js')}}
@stop
@endif
@section('content')
@if(isset($showAdvice)&&$showAdvice)
<div class="alert alert-info">
	<p>Valitse ajankohdan sopivuutta kuvaava väri klikkaamalla toistuvasti taulukon ruutua. Klikkaa sen jälkeen "Tallenna vastaukset" -nappulaan taulukon alapuolella.</p>
</div>
@endif
<h1>{{$poll->toimikunta}}</h1>
<p>{{$poll->description}}</p>
{{ Form::open(array('action' => 'AnswerController@updateSopivuus', 'id'=>'pollform', 'method' => 'PUT')) }} {{-- , 'method'=>'GET' Here starts form for answers --}}

<table class="table table-bordered">
	<thead>
		<tr>
			<th class="col-md-1">
				{{--<a type="button" class="btn btn-default btn-block" aria-label="Muokkaa" href="{{URL::to('/timeidea/create')}}">
  					<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
				</a>--}}
				@if(Auth::user() && Auth::user()->is_admin)
					<div class="allusersactive btn-default">valitse kaikki / poista valinnat</div>
				@endif
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
			@if (!empty($lurkers))
			@foreach($lurkers as $lurker)
			<td class="col-md-1 lurkers" data-lurkerid = "{{$lurker->id}}" data-islurker = 'true'>
					{{$lurker->name}}
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
			<td class="allred btn-default" data-userid="{{$user->id}}">mikään ei sovi</td>
		@endforeach
		@foreach($lurkers as $lurker)
			<td class="allredlurker btn-default" data-lurkerid="{{$lurker->id}}">mikään ei sovi</td>
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
<div class="col-md-4 col-md-offset-5">
	<table class="table table-bordered selitykset">
		<tbody>
			<tr>
				<td class="eisovi"><b>ei sovi</b></td>
				<td class="sopii"><b>sopii</b></td>
				<td class="parhaiten"><b>paras</b></td>		
				<td class="entieda"><b>en tiedä</b></td>
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
		<a class='btn btn-primary' href={{action('PollController@edit', ['id' => $poll->id])}} role='button'>Muokkaa kyselyä</a>
	</div>
	<div class="row top15">
    @include('poll.toggleopen')
	</div>
	{{ Form::open(array('action' => array('PollController@makeACommittee', $poll->id), 'id'=>'committeeform', 'method'=>'POST')) }}
	{{ Form::hidden('time', '', array('class' => 'valittuaika')) }}
	<div class = "valitutuserit hidden">
		@foreach($users as $user)
			{{ Form::checkbox('user[]', $user->id) }}
		@endforeach
	</div>
	<div class="row top15">
		{{ Form::submit('Muodosta toimikunta', array('class' => 'btn btn-primary')) }}
	</div>
	{{ Form::close() }}
	<div class="row top15">
	{{ Form::open(array('action' => array('PollController@makeACopy', $poll->id), 'method'=>'POST')) }}
	{{ Form::submit('Tee kopio tästä kyselystä', array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
	</div>
	</div>
@endif
@stop
