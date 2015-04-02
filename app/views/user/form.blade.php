@if($create)
<div class="form-group @if ($errors->has('username')) has-error @endif" >
{{ Form::label('username', 'Käyttäjätunnus', array('class' => 'control-label col-sm-2'))}}
<div class="col-sm-10">
{{ Form::text('username', (Input::old('username') ? Input::old('username') : $user->username), array('class' => 'form-control')) }}
</div>
</div>
@endif
<div class="form-group @if ($errors->has('first_name')) has-error @endif">
{{ Form::label('first_name', 'Etunimi', array('class' => 'control-label col-sm-2'))}}
<div class="col-sm-10">
{{ Form::text('first_name', (Input::old('first_name') ? Input::old('first_name') : $user->first_name), array('class' => 'form-control')) }}
</div>
</div>
<div class="form-group @if ($errors->has('last_name')) has-error @endif">
{{ Form::label('last_name', 'Sukunimi', array('class' => 'control-label col-sm-2'))}}
<div class="col-sm-10">
{{ Form::text('last_name', (Input::old('last_name') ? Input::old('last_name') : $user->last_name), array('class' => 'form-control')) }}
</div>
</div>
<div class="form-group @if ($errors->has('last_name')) has-error @endif">
{{ Form::label('email', 'Sähköposti', array('class' => 'control-label col-sm-2'))}}
<div class="col-sm-10">
{{ Form::text('email', (Input::old('email') ? Input::old('email') : $user->email), array('class' => 'form-control')) }}
</div>
</div>
<div class="form-group @if ($errors->has('department')) has-error @endif">
{{ Form::label('department', 'Laitos', array('class' => 'control-label col-sm-2'))}}
<div class="col-sm-10">
{{ Form::text('department', (Input::old('department') ? Input::old('department') : $user->department), array('class' => 'form-control')) }}
</div>
</div>
<div class="form-group @if ($errors->has('position')) has-error @endif">
{{ Form::label('position', 'Asema', array('class' => 'control-label col-sm-2'))}}
<div class="col-sm-10">
{{ Form::text('position', (Input::old('position') ? Input::old('position') : $user->position), array('class' => 'form-control')) }}
</div>
</div>
<div class="form-group @if ($errors->has('description')) has-error @endif">
{{ Form::label('description', 'Kuvaus', array('class' => 'control-label col-sm-2'))}}
<div class="col-sm-10">
{{ Form::textarea('description', (Input::old('description') ? Input::old('description') : $user->description), array('class' => 'form-control')) }}
</div>
</div>