<div class=form-inline>
{{ Form::open(array('action'=>'comment.store')) }}
<div class="form-group">
{{ Form::text('commenttext','',array('placeholder'=>'Kommentti')) }}
@if (!Auth::user())
{{ Form::text('author_name','',array('placeholder'=>'Käyttäjänimi'))}}
@endif
{{ Form::hidden('poll_id', $poll->id) }}
</div>
<div class="form-group">
{{ Form::submit('Kommentoi', array('class'=>'btn btn-default'))}}
{{ Form::close() }}
</div>
</div>
