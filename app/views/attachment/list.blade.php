<div class="col-md-7">
<h2>Liitetiedostot</h2>
<table class="table">
<tbody>
@foreach($committee->attachments as $attachment)
	<tr>
		<td><a href="/committee/{{$committee->id}}/attachment/{{$attachment->id}}">{{$attachment->filename}}</a></td>
	</tr>
@endforeach
</tbody>
</div>
</div>
