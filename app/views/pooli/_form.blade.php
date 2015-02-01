{{ Form::open(array('action' => 'poll.create', 'method' => 'get')) }}

{{ Form::label('toimikunta', 'Valitse toimikunnalle nimi' )}}
{{ Form::text('toimikunta') }}
{{ Form::submit('Luo uusi kysely', array('class' => 'btn btn-primary')) }}

<table class="pooltable table table-hover">
  <thead>
    <tr>
      <th>Etunimi</th>
      <th>Sukunimi</th>
      <th>Laitos</th>
      <th>Virka</th>
    </tr>
  </thead>
  <tbody>
  @foreach($users as $user)

    <tr data-userid="{{$user->id}}" >
      <td>{{$user->first_name}}<input class="userselector hidden" type="checkbox" name='user_{{$user->id}}' value="{{$user->id}}"></td>
      <td>{{$user->last_name}}</td>
      <td>{{$user->department}}</td>
      <td>{{$user->position}}</td>
    </tr>

  @endforeach
  </tbody>
</table>
{{ Form::close() }}

