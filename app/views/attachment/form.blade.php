<div class="row">
{{ Form::open(array('action'=>'AttachmentController@store','files'=>true,'method'=>'post','class'=>'form-horizontal')) }}
{{ Form::file('tiedosto',array('class'=>'btn btn-default top7')) }}
{{ Form::hidden('committee_id',$committee->id) }}
{{ Form::submit('Lisää tiedosto!',array('class'=>'btn btn-default top7')) }}
{{ Form::close() }}
</div>
