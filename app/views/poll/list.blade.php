<div class="list-group">
@foreach($polls as $poll)
<a href={{route('poll.show', $poll->id)}} class="list-group-item">{{ $poll->toimikunta }}</a><!-- poll.show ei toiminut jostain syystä -->
@endforeach
</div>