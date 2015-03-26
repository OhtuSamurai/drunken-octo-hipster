{{Form::open(array('action' => 'LurkerController@store'))}}
{{Form::text('name')}}
{{Form::hidden('poll_id', $poll->id)}}
{{Form::submit('Lisää henkilö', ['class' => 'btn btn-default'])}}
{{Form::close()}}