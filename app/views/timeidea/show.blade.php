<tr class="timeidea">
	<th>
		{{ date('l', strtotime($timeidea->date)) }}
		{{ date("H:i", strtotime($timeidea->begins) ) . " - " . date("H:i", strtotime($timeidea->ends) ) }}
	</th>
	
	@foreach($users as $user)
		@foreach($answers as $answer)
			@if($answer->participant_id == $user->id)
			<td class="{{$answer->sopivuus}}">
				{{Form::select('size', array('S' => 'Sopii', 'P' => 'Paras', 'E' => 'Ei'), 'S', array('class'=>'selectedvalue hidden'))}}
			</td>
			@endif
		@endforeach
	@endforeach

	<td class="howmany">1/1</td>
</tr>
