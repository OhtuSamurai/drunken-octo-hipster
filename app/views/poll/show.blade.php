@extends('layouts.master')
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
				<tr>
					<th>Maanantai 12-14</th>
					<td>

						<table>
							<tr>
								<td class="kysy">Paras</td>
							</tr>
							<tr>
								<td class="kysy">Sopii</td>
							</tr>
							<tr>
								<td class="kysy">Ei sovi</td>
							</tr>
						</table>
					</td>
					<td class="eisovi"></td>
					<td class="eisovi"></td>
					<td class="eisovi"></td>
					<td class="sopii"></td>
					<td>1/1</td>
				</tr>
				<tr>
					<th>Tiistai 10-12 </th>
					<td>
						<table>
							<tr>
								<td class="kysy">Paras</td>
							</tr>
							<tr>
								<td class="kysy">Sopii</td>
							</tr>
							<tr>
								<td class="kysy">Ei sovi</td>
							</tr>
						</table>
					</td>
					<td class="parhaiten"></td>
					<td class="parhaiten"></td>
					<td class="sopii"></td>
					<td class="parhaiten"></td>
					<td>3/2</td>
				</tr>
			</tbody>
		</table>
    <button type="submit" class="btn btn-default">Sulje kysely</button>
@stop
