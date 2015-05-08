{{Form::open(array('action'=>array('AttachmentController@destroy', $committee->id, $attachment->id), 'method'=>'delete'))}}
{{Form::submit('Poista tiedosto',array('class'=>'btn btn-default'))}}
{{Form::close() }}