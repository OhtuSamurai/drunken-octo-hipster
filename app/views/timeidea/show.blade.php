<tr class="timeidea">
	<th>
		{{ date('l', strtotime($timeidea->date)) }}
		{{ date("H:i", strtotime($timeidea->begins) ) . " - " . date("H:i", strtotime($timeidea->ends) ) }}
	</th>
	
	@foreach($users as $user)
		@foreach($answers as $answer)
			@if($answer->participant_id == $user->id)
			<td class="options {{$answer->sopivuus}}">
				{{Form::select('size', array('sopii' => 'Sopii', 'paras' => 'Paras', 'eisovi' => 'Ei'), $answer->sopivuus, array('class'=>'selectedvalue hidden'))}}
				 {{--{{ substr(ucfirst($answer->sopivuus), 0, 1) }} tulostaa sopivuuden etukirjaimen isolla --}}
			</td>
			@endif
		@endforeach
	@endforeach

	<td class="howmany">1/1</td>
</tr>
