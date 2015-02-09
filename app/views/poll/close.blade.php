{{ Form::model($poll, array('route' => array('poll.update', $poll->id), 'method' => 'put' )) }}

{{ Form::hidden('is_open', 0) }}

{{ Form::submit('Sulje kysely', array('class' => 'btn btn-default')) }}

{{ Form::close() }}