@extends('layouts.master')

@if($poll->is_open)
@section('pagehead')
  {{HTML::script('javascript/poll_timeidea.js')}}
@stop
@endif

@section('content')
	<h1>Sopivat ajat opetustaitotoimikunnan {{$poll->toimikunta}} tapaamiseen</h1>
  {{ Form::open(array('action' => 'AnswerController@updateSopivuus', 'id'=>'pollform', 'method'=>'GET')) }} {{-- Here starts form for answers --}}
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
					<td class="col-md-1">{{$user->first_name}}</td>
				@endforeach
				@endif
			</tr>
		</thead>
		<tbody>
			@foreach($timeideas as $timeidea)
				@include('timeidea.show')		
			@endforeach
		</tbody>
	</table>
	
	<table class="table table-bordered selitykset">
		<tbody>
			<tr>
				<td class="eisovi">ei sovi</td>
				<td class="sopii">sopii</td>
				<td class="parhaiten">paras</td>		
			</tr>
		</tbody>
	</table>
	
	@if($poll->is_open)
    	@include('answer._form') {{-- Here ends form for answers --}}
    	@include('timeidea._form')
    	@include('poll.close')
    @endif

@stop
