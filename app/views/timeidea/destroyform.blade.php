{{Form::open(array('url'=>'poll/'.$poll->id.'/edit/deletetime/'.$idea->id,'method'=>'delete'))}}
{{Form::submit('Poista',array('class'=>'btn btn-default'))}}
{{Form::close()}}
