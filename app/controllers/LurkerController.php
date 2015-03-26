<?php

class LurkerController extends \BaseController {

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(!Auth::check() or !Auth::User()->is_admin)
			return Redirect::action('PollController@edit', ['id' => Input::get('poll_id')])->withErrors("Toiminto evätty!");
		if(!Input::has('name'))
			return Redirect::action('PollController@edit', ['id' => Input::get('poll_id')])->withErrors('Käyttäjän nimi unohtui');
		$lurker = new Lurker;
		$lurker->poll_id = Input::get('poll_id'); 
		$lurker->name = Input::get('name');
		$lurker->save();
		return Redirect::action('PollController@show', ['id' => $lurker->poll_id]);
	}
}
