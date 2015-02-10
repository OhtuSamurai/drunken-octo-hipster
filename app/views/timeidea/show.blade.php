<tr class="timeidea">
	<th>
		{{ date('l', strtotime($timeidea->date)) }}
		{{ date("H:i", strtotime($timeidea->begins) ) . " - " . date("H:i", strtotime($timeidea->ends) ) }}
	</th>
	
	@foreach($users as $user)
		<td class="options">
			{{Form::label('size')}}
			{{Form::select('size', array('S' => 'Sopii', 'P' => 'Paras', 'E' => 'Ei'), 'S', array('class'=>'selectedvalue hidden'))}}
		</td>
	@endforeach

	<td class="howmany">1/1</td>
</tr>