@extends('layouts.master')

@section('pagehead')
  {{HTML::script('javascript/poll_timeidea.js')}}
@stop

@section('content')
  <h1>Sopivat ajat opetustaitotoimikunnan {{$poll->toimikunta}} tapaamiseen</h1>
  <table class="table table-bordered">
		<thead>
			<tr>
				<th class="col-md-1">
					<a type="button" class="btn btn-default btn-block" aria-label="Muokkaa" href="/timeidea/create">
  						<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
					</a>
				</th>
				@foreach($users as $user)
					<td class="col-md-1">{{$user->first_name}}</td>
				@endforeach
			</tr>
		</thead>
			<tbody>
				@foreach($timeideas as $timeidea)
					@include('timeidea.show')		
				@endforeach
			</tbody>
		</table>
	@if($poll->is_open)
    	@include('answer._form')
    	@include('timeidea._form')
    	@include('poll.close')
    @endif
@stop
