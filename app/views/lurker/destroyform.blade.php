{{Form::open(array('url'=>'poll/'.$poll->id.'/edit/remove/'.$lurker->id,'method'=>'delete'))}}
{{Form::submit('Poista',array('class'=>'btn btn-default'))}}
{{Form::close()}}
