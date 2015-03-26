<tr class="timeidea">
	<th data-id= "{{$timeidea->id}}" data-description = "{{$timeidea->description}}">
		{{ $timeidea->description; }}
	</th>
	
	@foreach($users as $user)
		@foreach($answers as $answer)
			@if($answer->participant_id == $user->id && $timeidea->id == $answer->timeidea_id)
			
			<td class="options {{$answer->sopivuus}}" data-userid="{{$user->id}}">
				{{Form::select('size', 
								array('sopii' => 'Sopii', 'parhaiten' => 'Parhaiten', 'eisovi' => 'Ei','entieda' => 'En tiedä', 'eivastattu' => 'eivastattu'), 
								$answer->sopivuus, 
								array('class'=>'selectedvalue hidden', 
									  'name'=>$answer->id, 
									  'value'=>$answer->sopivuus,
									  'data-clicked'=>'false'))}}			
			</td>
			@endif
		@endforeach
	@endforeach

	@foreach($lurkers as $lurker)
		@foreach($answers as $answer)
			@if($answer->lurker_id == $lurker->id && $timeidea->id == $answer->timeidea_id)
			
			<td class="options {{$answer->sopivuus}}">
{{--		<td class="options {{$answer->sopivuus}}" data-userid="{{$user->id}}"> --}}
				{{Form::select('size', 
								array('sopii' => 'Sopii', 'parhaiten' => 'Parhaiten', 'eisovi' => 'Ei','entieda' => 'En tiedä', 'eivastattu' => 'eivastattu'), 
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
		<span class="best"></span>
		<span class="isokay"></span>
		<span class="no"></span>
	</td>
</tr>
