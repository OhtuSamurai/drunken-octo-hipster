<?php

class LurkerController extends \BaseController {

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$poll = Poll::find(Input::get('poll_id'));
		if(!Auth::check() or !Auth::User()->is_admin)
			return Redirect::action('PollController@edit', ['id' => $poll->id])->withErrors("Toiminto evätty!");
		if(!Input::has('name'))
			return Redirect::action('PollController@edit', ['id' => $poll->id])->withErrors('Käyttäjän nimi unohtui');
		$lurker = new Lurker;
		$lurker->poll_id = Input::get('poll_id'); 
		$lurker->name = Input::get('name');
		$lurker->save();

		$timeideas = $poll->timeideas;
		foreach($timeideas as $timeidea)
		{
			$answer = new Answer;
			$answer->lurker_id = $lurker->id;
			$answer->timeidea_id = $timeidea->id;
			$answer->sopivuus = 'eivastattu';
			$answer->save();
		}

		return Redirect::action('PollController@edit', ['id' => $poll->id])->with('success', 'Käyttäjä '.$lurker->name.' lisätty' );
	}

	public function destroy($poll_id,$lurker_id) {
		if (!Auth::check() or !Auth::user()->is_admin)
			return Redirect::action('PollController@edit', ['id' => $poll_id])->withErrors("Toiminto evätty!");
		Lurker::find($lurker_id)->delete();
		return Redirect::action('PollController@edit',['id'=>$poll_id])->with('success','Käyttäjä poistettiin kyselystä!');	
	}
}
