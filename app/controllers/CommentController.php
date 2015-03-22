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
		$comment->user_id = Auth::user()->id;
		$comment->poll_id = $pollid;
		$comment->save();
		return Redirect::route('poll.show',$pollid);	
	}
	/** 
	* Näyttää uuden kommentin luomiseen tarvittavat asiat 
	*/
	public function create() {
		
	
	}
}
