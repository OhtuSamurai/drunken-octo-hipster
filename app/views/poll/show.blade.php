@extends('layouts.master')
@section('content')
  <h1>Sopivat ajat opetustaitotoimikunnan {{$poll->toimikunta}} tapaamiseen</h1>
  <table class="table table-bordered">
			<thead>
				<tr>
					<th class="col-md-1">
						<button type="button" class="btn btn-default btn-block" aria-label="Muokkaa" href="pooli">
  						<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
						</button>
					</th>

					@foreach($users as $user)
						<td class="col-md-1">{{$user->first_name}}</td>
					@endforeach
				</tr>
			</thead>
@stop
