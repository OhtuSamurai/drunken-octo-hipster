@extends('layouts.master')

@section('content')
  <h1>Meneillään olevat kyselyt</h1>

  <div class="list-group">
  @foreach($polls as $poll)
  <a href={{route('poll.show', $poll->id)}} class="list-group-item">{{ $poll->toimikunta }}<a/> <!-- poll.show ei toiminut jostain syystä -->
  @endforeach
  </div>

  <p><a href="#" class="btn btn-default" role="button">Luo uusi toimikunta</a></p>
@stop
