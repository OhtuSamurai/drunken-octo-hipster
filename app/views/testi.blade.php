@extends('layouts.master')

@section('content')
<div class="container">
		<h1>Sopivat ajat opetustaitotoimikunnan tapaamiseen</h1>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th class="col-md-1"></th>
					<th class="col-md-1">Pekka</th>
					<th class="col-md-1">Minni</th>
					<th class="col-md-1">Mikki</th>
					<th class="col-md-1">Matti</th>
					<th class="col-md-1">Tapio</th>
					<th class="col-md-1">Liisa</th>
					<th class="col-md-1">Tulos</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th>Maanantai 12-14</th>
					<td class="eisovi"></td>
					<td class="eisovi"></td>
					<td class="eisovi"></td>
					<td class="eisovi"></td>
					<td class="sopii"></td>
					<td class="parhaiten"></td>
					<td>1/1</td>
				</tr>
				<tr>
					<th>Tiistai 10-12 </th>
					<td class="sopii"></td>
					<td class="parhaiten"></td>
					<td class="parhaiten"></td>
					<td class="sopii"></td>
					<td class="parhaiten"></td>
					<td class="eisovi"></td>
					<td>3/2</td>
				</tr>
				<tr>
					<th>Tiistai 12-14</th>
					<td class="parhaiten"></td>
					<td class="eisovi"></td>
					<td class="sopii"></td>
					<td class="sopii"></td>
					<td class="sopii"></td>
					<td class="parhaiten"></td>
					<td>2/3</td>
				</tr>
			</tbody>
		</table>
		</div>
@stop
