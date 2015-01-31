{{ Form::open(array('action' => 'PollController@create')) }}

{{ Form::label('toimikunta', 'Valitse toimikunnalle nimi' )}}
{{ Form::text('toimikunta') }}
{{ Form::submit('Luo uusi kysely') }}

<table class="table table-hover">
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
    <tr>
      <td>{{$user->first_name}}</td>
      <td>{{$user->last_name}}</td>
      <td>{{$user->department}}</td>
      <td>{{$user->position}}</td>
      </tr>
  @endforeach
  </tbody>
</table>
{{ Form::close() }}

