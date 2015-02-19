{{ Form::open(array('action' => 'timeidea.store')) }}

{{ Form::hidden('poll_id', $poll->id) }}

{{ Form::label('description', 'Uusi ajankohtaehdotus' )}}
{{ Form::text('description')}}

{{ Form::submit('Lisää ajankohta', array('class' => 'btn btn-primary')) }}

{{ Form::close()}}
