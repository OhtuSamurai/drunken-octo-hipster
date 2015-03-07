<tr class="timeidea">
	<th data-id= "{{$timeidea->id}}" data-description = "{{$timeidea->description}}">
		{{ $timeidea->description; }}
	</th>
	
	@foreach($users as $user)
		@foreach($answers as $answer)
			@if($answer->participant_id == $user->id && $timeidea->id == $answer->timeidea_id)
			
			<td class="options {{$answer->sopivuus}}" data-userid="{{$user->id}}">
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

	<td class="howmany">
		<div class="best"></div>
		<div class="isokay"></div>
		<div class="no"></div>
	</td>
</tr>
