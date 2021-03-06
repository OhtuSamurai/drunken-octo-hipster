<table class="table table-striped">
	<tr>
		<th>Nimi</th>
		<th>Profiili luotu</th>	
		<th>Osallistunut komiteaan</th>
		<th>Osallistunut kyselyyn</th>
		<th>Monessako avoimessa kyselyssä</th>
		<th>Monessako avoimessa toimikunnasssa</th>
		<th>Kommentteja</th>
	</tr>
	@foreach($users as $user) 
		<tr>
			<td><a href="{{URL::to('/user/'.$user->id)}}">{{$user->first_name." ".$user->last_name}}</a></td>	
			<td class="center">{{date('d.m.Y',strtotime($user->created_at))}}</td>
			<td class="center">{{$user->n_committee()}}</td>
			<td class="center">{{$user->n_poll()}}</td>
			<td class="center">{{$user->curr_polls()->count()}}</td>
			<td class="center">{{$user->curr_committees()->count()}}</td>
			<td class="center">{{$user->n_comment()}}</td>
		</tr>
	@endforeach
</table>
