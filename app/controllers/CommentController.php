<?php
class CommentController extends \BaseController {
	/**
	* Luo ja tallentaa uuden kommentin ja päivittää lopuksi polli näkymän
	* REFAKTORY NEEDED!
	*/
	public function store() {
		$comment = new Comment;
		$comment->commenttext = Input::get('commenttext');
		if(Input::has('poll_id'))
		{
			if (Auth::check())
				$comment->user_id = Auth::user()->id;
			if(!Auth::check())
				$comment->author_name = (Input::get('author_name') ? Input::get('author_name') : "Anonyymi");
			$comment->poll_id = Input::get('poll_id');
			$validator = $comment->validator();
			if ($validator->fails())
				return Redirect::route('poll.show',$comment->poll_id)->withErrors($validator);
			$comment->save();
			return Redirect::route('poll.show',$comment->poll_id);
		}
		if(Input::has('committee_id')) 
		{
			$committee = Committee::find(Input::get('committee_id'));
			if(!Auth::check())
				return Redirect::action('CommitteeController@show', ['id' => $committee->id])->withErrors("Vain toimikunnan jäsenet voivat kommentoida!");
			if(!$committee->users->contains(Auth::user()) AND !Auth::user()->is_admin)
				return Redirect::action('CommitteeController@show', ['id' => $committee->id])->withErrors("Et voi kommentoida, koska et kuulu toimikuntaan!");
			$comment->committee_id = $committee->id;
			$comment->user_id = Auth::user()->id;
			$validator = $comment->validator();
			if ($validator->fails())
				return Redirect::action('CommitteeController@show',['id' => $committee->id])->withErrors($validator);
			$comment->save();
			return Redirect::action('CommitteeController@show', ['id' => $committee->id]);
		}
		return Redirect::to('/')->withErrors("Tapahtui virhe!");
	}
}
