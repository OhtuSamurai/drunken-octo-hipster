@if(Auth::user())

<div class = "selectall btn-default">valitse kaikki</div>
<table class="pooltable table table-hover">
  <thead>
    <tr>
      <th class = "firstname">Etunimi</th>
      <th class = "lastname">Sukunimi</th>
      <th class = "email">Sähköposti</th>
      <th class = "department">Laitos</th>
      <th class = "position">Asema</th>
    </tr>
  </thead>
  <tbody>
  @foreach($users as $user)

    <tr class="rivit" data-userid="{{$user->id}}" >
      <td><a href="{{URL::to('/user/'.$user->id)}}">{{$user->first_name}}</a><input class="userselector hidden" type="checkbox" name="user[]" value="{{$user->id}}"></td>
      <td>{{$user->last_name}}</td>
      <td>{{$user->email}}</td>
      <td>{{$user->department}}</td>
      <td>{{$user->position}}</td>
    </tr>

  @endforeach
  </tbody>
</table>

@endif
