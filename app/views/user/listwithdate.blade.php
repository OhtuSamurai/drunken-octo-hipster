<table class="table table-striped">
	<tr>
		<th>Nimi</th>
		<th>Profiili luotu</th>	
		<th>Osallistunut komiteaan</th>
		<th>Osallistunut kyselyyn</th>
		<th>Monessako avoimessa kyselyssä</th>
		<th>Monessako avoimessa toimikunnasssa</th>
	</tr>
	@foreach($users as $user) 
		<tr>
			<td><a href="user/{{$user->id}}">{{$user->first_name." ".$user->last_name}}</a></td>	
			<td class="center">{{date('d.m.Y',strtotime($user->created_at))}}</td>
			<td class="center">{{$user->n_committee()}}</td>
			<td class="center">{{$user->n_poll()}}</td>
			<td class="center">{{$user->curr_polls()->count()}}</td>
			<td class="center">{{$user->curr_committees()->count()}}</td>
		</tr>
	@endforeach
</table>
