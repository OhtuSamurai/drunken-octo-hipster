<tr class="timeidea">
	<th>
		{{ $timeidea->description; }}
	</th>
	<?php
	$sopivat=0;
	$parhaat=0;
	?>	
	@foreach($users as $user)
		@foreach($answers as $answer)
			@if($answer->participant_id == $user->id && $timeidea->id == $answer->timeidea_id)
			<?php 
			if ($answer->sopivuus=='parhaiten') {
				$parhaat++;
				$sopivat++;
			}
			if ($answer->sopivuus=='sopii') 
				$sopivat++;
			?>
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

	<td class="howmany"><?php echo $parhaat ?>/<?php echo $sopivat ?></td>
</tr>
