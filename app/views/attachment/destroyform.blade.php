{{Form::open(array('url'=>'committee/'.$committee->id.'/attachment/'.$attachment->id,'method'=>'delete'))}}
{{Form::submit('Poista tiedosto',array('class'=>'btn btn-default'))}}
{{Form::close() }}
