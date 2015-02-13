<tr class="timeidea">
	<th>
		{{ date('l', strtotime($timeidea->date)) }}
		{{ date("H:i", strtotime($timeidea->begins) ) . " - " . date("H:i", strtotime($timeidea->ends) ) }}
	</th>
	
	@foreach($users as $user)
		@foreach($answers as $answer)
			@if($answer->participant_id == $user->id && $timeidea->id == $answer->timeidea_id)
			<td class="options {{$answer->sopivuus}}">
				{{Form::select('size', 
								array('sopii' => 'Sopii', 'parhaiten' => 'Parhaiten', 'eisovi' => 'Ei'), 
								$answer->sopivuus, 
								array('class'=>'selectedvalue hidden', 
									  'name'=>$answer->id, 
									  'value'=>$answer->sopivuus))}}			
			</td>
			@endif
		@endforeach
	@endforeach

	<td class="howmany">1/1</td>
</tr>
