@extends('layouts.master')

@section('content')
  <h1>Meneillään olevat kyselyt</h1>

  <div class="list-group">
  @foreach($polls as $poll)
  <a href="#" class="list-group-item">{{ $poll->toimikunta }}<a/>
  @endforeach
  </div>

  <p><a href="#" class="btn btn-default" role="button">Luo uusi toimikunta</a></p>
@stop
