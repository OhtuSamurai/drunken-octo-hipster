<table class="pooltable table table-hover">
	@if(isset($polls))
		<h3>Ei avoimia kyselyjä</h3>
	@endif
	@if(!isset($polls))
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
	@endif
