<tr class="timeidea">
	{{--<th>{{$timeidea->date}}{{timeidea->begins}}{{timeidea->ends}}</th>--}}
	<th>Maanantai 12-14</th>
	@foreach($users as $user)
		<td class="options">{{Form::select('size', array('S' => 'Sopii', 'P' => 'Paras', 'E' => 'Ei'), 'S', array('class'=>'selectedvalue hidden'))}}</td>
	@endforeach

	<td class="howmany">1/1</td>
</tr>

