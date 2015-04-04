<h2>Liitteet</h2>
<table class="table">
<tbody>
@foreach($committee->attachments as $attachment)
	<tr>
		<td><a href="/committee/{{$committee->id}}/attachment/{{$attachment->id}}">{{$attachment->filename}}</a></td>

			<td>
			@foreach($attachment->users as $user)
				<a href="/user/{{$user->id}}">{{$user->first_name}} </a> 
			@endforeach
			</td>
	</tr>
@endforeach
</tbody>
</div>
