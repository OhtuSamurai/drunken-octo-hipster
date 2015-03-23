<?php

class LurkerController extends \BaseController {

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$lurker = new Lurker;
		$luker->name = Input::get('name');
		$lurker->save();
		return Redirect::action('PollController@show', ['id' => Input::get('poll_id')]);
	}
}
