<h2>Liitteet</h2>
<table class="table">
<thead>
	<tr>
		<th>Tiedosto</th>
		<th>Lukeneet</th>
	</tr>
</thead>
<tbody>
@foreach($committee->attachments as $attachment)
	
	@if ((!in_array(Auth::user()->id,$attachment->getUserIDs()))&&(!Auth::user()->is_admin)&&$committee->is_open)
	<tr class="halytys">
	@else <tr>
	@endif
		<td><a href="{{URL::to('/committee/'.$committee->id.'/attachment/'.$attachment->id)}}">{{$attachment->filename}}</a></td>

			<td>
			@foreach($attachment->users as $user)
				<a href="{{URL::to('/user/'.$user->id)}}">{{$user->first_name}} </a> 
			@endforeach
			</td>
			@if (Auth::user() && Auth::user()->is_admin)
			<td>
				@include('attachment.destroyform')
			<td>
			@endif

			@if ((!in_array(Auth::user()->id,$attachment->getUserIDs()))&&(!Auth::user()->is_admin)&&$committee->is_open)
			<td class="halytys"><b>Lue tämä liite!</b></td>
			@endif
	</tr>
@endforeach
</tbody>
</div>
