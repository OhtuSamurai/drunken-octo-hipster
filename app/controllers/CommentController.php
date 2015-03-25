<?php
class CommentController extends \BaseController {
	/**
	* Luo ja tallentaa uuden kommentin ja päivittää lopuksi polli näkymän 
	*/
	public function store() {
		$pollid = Input::get('poll_id');
		$commenttext = Input::get('commenttext');
		$comment = new Comment;
		$comment->commenttext = $commenttext;
		if (Auth::user())
			$comment->user_id = Auth::user()->id;
		else
			$comment->author_name = (Input::get('author_name') ? Input::get('author_name') : "Anonyymi");
		$comment->poll_id = $pollid;
		$validator = $comment->validator();
		if ($validator->fails())
			return Redirect::route('poll.show',$pollid)->withErrors($validator);
		$comment->save();
		return Redirect::route('poll.show',$pollid);	
	}

}
