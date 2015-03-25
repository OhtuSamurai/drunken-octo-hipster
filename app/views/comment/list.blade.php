<div class="detailBox">
	<div class="titleBox">
		<label>Kommentit</label>
	</div>
	<div class="actionBox">
		<ul class="commentList">
			@foreach($comments as $comment)
				<div class="commentText">
					<p>{{$comment->commenttext}}</p>
					<span class="date sub-text">
					@if ($comment->user)
						<a href="/user/{{$comment->user->id}}">{{$comment->user->first_name}}</a>
					@else
						{{$comment->author_name}}
					@endif
					{{$comment->created_at}}
					</span>
				</div>	
			@endforeach
		</ul>
		
		@include('comment.create-form')
	
	</div>
</div>
