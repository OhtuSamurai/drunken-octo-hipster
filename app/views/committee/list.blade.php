<table class="pooltable table table-hover">
  <thead>
    <tr>
      <th>Nimi</th>
      <th>Kokoontumisaika</th>
      <th>Jäsenten lukumäärä</th>
    </tr>
  </thead>
  <tbody>
  @foreach($committees as $committee)
    <tr data-userid="{{$committee->id}}" >
      <td><a href={{route('committee.show', $committee->id)}}>{{$committee->name}}</a></td>
      <td>{{$committee->time}}</td>
      <td>{{$committee->users()->count()}}</td>
    </tr>
  @endforeach
  </tbody>
</table>
