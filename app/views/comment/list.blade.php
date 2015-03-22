<div class="detailBox">
	<div class="titleBox">
		<label>Kommentit</label>
	</div>
	<div class="actionBox">
		<ul class="commentList">
			@foreach($comments as $comment)
				<div class="commentText">
					<p>{{$comment->commenttext}}</p>
					<span class="date sub-text">{{$comment->user->first_name}} {{$comment->created_at}} </span>
				</div>	
			@endforeach
		</ul>
		@if (Auth::user())
			@include('comment.create-form')
		@endif
	</div>
</div>
