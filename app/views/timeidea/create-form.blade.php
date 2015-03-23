{{ Form::open(array('action' => 'timeidea.store')) }}

{{ Form::hidden('poll_id', $poll->id) }}

{{ Form::text('description')}}

{{ Form::submit('Lisää ajankohta', array('class' => 'btn btn-default')) }}

{{ Form::close()}}
