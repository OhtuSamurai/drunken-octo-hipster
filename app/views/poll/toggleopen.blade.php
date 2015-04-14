@if($poll->is_open)
{{ Form::open(array('url' => '/poll/'.$poll->id.'/toggleopen')) }}
{{ Form::submit('Sulje kysely', array('class' => 'btn btn-primary')) }}
{{ Form::close() }}
@else
Kysely on suljettu.
{{ Form::open(array('url' => '/poll/'.$poll->id.'/toggleopen')) }}
{{ Form::submit('Avaa uudelleen', array('class' => 'btn btn-primary')) }}
{{ Form::close() }}
@endif