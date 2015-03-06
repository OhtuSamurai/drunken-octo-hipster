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