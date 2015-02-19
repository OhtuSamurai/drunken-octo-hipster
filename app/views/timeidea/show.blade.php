<tr class="timeidea">
	<th>
		{{ $timeidea->description; }}
	</th>
	
	@foreach($users as $user)
		@foreach($answers as $answer)
			@if($answer->participant_id == $user->id && $timeidea->id == $answer->timeidea_id)
			<td class="options {{$answer->sopivuus}}">
				{{Form::select('size', 
								array('sopii' => 'Sopii', 'parhaiten' => 'Parhaiten', 'eisovi' => 'Ei', 'eivastattu' => 'eivastattu'), 
								$answer->sopivuus, 
								array('class'=>'selectedvalue hidden', 
									  'name'=>$answer->id, 
									  'value'=>$answer->sopivuus,
									  'data-clicked'=>'false'))}}			
			</td>
			@endif
		@endforeach
	@endforeach

	<td class="howmany">1/1</td>
</tr>
