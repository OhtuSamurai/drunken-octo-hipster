<table class="pooltable table table-hover">
  <thead>
    <tr>
      <th>Ajankohdat</th>
    </tr>
  </thead>
  <tbody>
  @foreach($poll->timeideas as $idea)
    	<tr>
		<td>{{$idea->description}}</td>
		<td>@include('timeidea.destroyform')</td>
	</tr>
  @endforeach
  </tbody>
</table>
