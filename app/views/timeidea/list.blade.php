<table class="pooltable table table-hover">
  <thead>
    <tr>
      <th>Ajankohdat</th>
    </tr>
  </thead>
  <tbody>
  @foreach($poll->timeideas as $idea)
    <tr><td>{{$idea->description}}</td></tr>
  @endforeach
  </tbody>
</table>