{{Form::open(array('action'=>array('LurkerController@destroy', $poll->id, $lurker->id), 'method'=>'delete'))}}
{{Form::submit('Poista',array('class'=>'btn btn-default'))}}
{{Form::close()}}
