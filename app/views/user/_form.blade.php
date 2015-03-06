@if(Auth::user() && Auth::user()->is_admin)
<h3>Uuden kyselyn luominen</h3>
{{ Form::open(array('action' => 'poll.store')) }}
{{ Form::label('toimikunta', 'Valitse toimikunnalle nimi' )}}
{{ Form::text('toimikunta') }}
{{ Form::submit('Luo uusi kysely', array('class' => 'btn btn-primary')) }}

@endif
<table class="pooltable table table-hover">
  <thead>
    <tr>
      <th>Etunimi</th>
      <th>Sukunimi</th>
      <th>Laitos</th>
      <th>Asema</th>
    </tr>
  </thead>
  <tbody>
  @foreach($users as $user)

    <tr data-userid="{{$user->id}}" >
      <td>{{$user->first_name}}<input class="userselector hidden" type="checkbox" name="user[]" value="{{$user->id}}"></td>
      <td>{{$user->last_name}}</td>
      <td>{{$user->department}}</td>
      <td>{{$user->position}}</td>
    </tr>

  @endforeach
  </tbody>
</table>
{{ Form::close() }}

@if(Auth::user() && Auth::user()->is_admin)
<h3>Uuden toimikunnan luominen</h3>
{{ Form::open(array('action' => 'committee.store')) }}
{{ Form::label('name', 'Valitse toimikunnalle nimi' )}}
{{ Form::text('name') }}
{{ Form::label('time', 'Kirjoita kokoontumisaika' )}}
{{ Form::text('time') }}
{{ Form::submit('Luo uusi toimikunta', array('class' => 'btn btn-primary')) }}

@endif
<table class="pooltable table table-hover">
  <thead>
    <tr>
      <th>Etunimi</th>
      <th>Sukunimi</th>
      <th>Laitos</th>
      <th>Asema</th>
    </tr>
  </thead>
  <tbody>
  @foreach($users as $user)

    <tr data-userid="{{$user->id}}" >
      <td>{{$user->first_name}}<input class="userselector hidden" type="checkbox" name="user[]" value="{{$user->id}}"></td>
      <td>{{$user->last_name}}</td>
      <td>{{$user->department}}</td>
      <td>{{$user->position}}</td>
    </tr>

  @endforeach
  </tbody>
</table>
{{ Form::close() }}

