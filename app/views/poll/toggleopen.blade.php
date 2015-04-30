@if($poll->is_open)
{{ Form::open(array('action' => array('PollController@toggleOpen', $poll->id))) }}
{{ Form::submit('Sulje kysely', array('class' => 'btn btn-primary')) }}
{{ Form::close() }}
@else
Kysely on suljettu.
{{ Form::open(array('action' => array('PollController@toggleOpen', $poll->id))) }}
{{ Form::submit('Avaa uudelleen', array('class' => 'btn btn-primary')) }}
{{ Form::close() }}
@endif