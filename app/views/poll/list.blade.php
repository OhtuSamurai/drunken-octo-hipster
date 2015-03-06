<table class="pooltable table table-hover">
  <thead>
    <tr>
      <th>Kysely</th>
      <th>Jäsenten lukumäärä</th>
    </tr>
  </thead>
  <tbody>
  @foreach($polls as $poll)
    <tr data-userid="{{$poll->id}}" >
      <td><a href={{route('poll.show', $poll->id)}}>{{$poll->toimikunta}}</a></td>
      <td>{{$poll->users()->count()}}</td>
    </tr>
  @endforeach
  </tbody>
</table>
