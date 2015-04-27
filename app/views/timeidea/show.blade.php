<tr class="timeidea">
	<th data-id= "{{$timeidea->id}}" data-description = "{{$timeidea->description}}">
		{{ $timeidea->description; }}
	</th>
	@if(Auth::user())
		<div class ="hidden kirjautunutuser" data-userid = "{{Auth::user()->id}}">Auth::user()->id</div>
	@endif
	
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
									  'data-clicked'=>'false',
									  'data-lurker'=>'false'))}}			
			</td>
			@endif
		@endforeach
	@endforeach

	@foreach($lurkers as $lurker)
		@foreach($answers as $answer)
			@if($answer->lurker_id == $lurker->id && $timeidea->id == $answer->timeidea_id)
			<td class="lurkeroptions {{$answer->sopivuus}}" data-lurkerid="{{$lurker->id}}">
				{{Form::select('size', 
								array('sopii' => 'Sopii', 'parhaiten' => 'Parhaiten', 'eisovi' => 'Ei','entieda' => 'En tiedä', 'eivastattu' => 'eivastattu'), 
								$answer->sopivuus, 
								array('class'=>'selectedvalue hidden', 
									  'name'=>$answer->id, 
									  'value'=>$answer->sopivuus,
									  'data-clicked'=>'false',
									  'data-lurker'=>'true'))}}			
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
