<table class="pooltable table table-hover">
  <thead>
    <tr>
      <th>Järjestelmän ulkopuoliset käyttäjät</th>
    </tr>
  </thead>
  <tbody>
  @foreach($poll->lurkers as $lurker)
    <tr><td>{{$lurker->name}}</td></tr>
  @endforeach
  </tbody>
</table>