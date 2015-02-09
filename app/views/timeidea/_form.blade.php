{{ Form::open(array('action' => 'timeidea.store')) }}

{{ Form::hidden('poll_id', $poll->id) }}

{{ Form::label('date', 'Valitse päivämäärä' )}}
{{ Form::text('date', date("d.m.Y")) }}

{{ Form::label('begins', 'Aloitusaika' )}}
{{ Form::text('begins', date("H:i")) }}

{{ Form::label('ends', 'Lopetusaika' )}}
{{ Form::text('ends', date("H:i",strtotime("+1 hours"))   )}}

{{ Form::submit('Lisää ajankohta', array('class' => 'btn btn-primary')) }}

{{ Form::close()}}