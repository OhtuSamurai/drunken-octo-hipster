<?php

class TimeideaController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		if (!Auth::user() || !Auth::user()->is_admin)
			return Redirect::route('poll.show', array('poll'=>Input::get('poll_id')))->withErrors("Toiminto evätty!");
		$poll = Poll::find(Input::get('poll_id'));
		$timeidea = new Timeidea;
		$timeidea->poll_id = $poll->id;
		$timeidea->description = Input::get('description');
		$validator = $timeidea->validator();
		if ($validator->fails()) {
			return Redirect::action('PollController@edit', $poll->id)->withErrors($validator);
		}
		$timeidea->save();
		foreach($poll->users as $user) {
			AnswerController::createAnswer($user->id, $timeidea->id, "participant_id");
		}
		foreach($poll->lurkers as $lurker) {
			AnswerController::createAnswer($lurker->id, $timeidea->id, "lurker_id");
		}
		return Redirect::action('PollController@edit',['id'=>$poll->id])->with('success','Ajankohta on lisätty kyselyyn');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$timeidea = Timeidea::find($id);
		return View::make('timeidea.show', array('timeidea' => $timeidea));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		//
	}
	
	

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($timeidea_id) {
		if (!Auth::user() || !Auth::user()->is_admin)
			return Redirect::to('/')->withErrors('Toiminto evätty!');
		$timeidea = Timeidea::find($timeidea_id);
		Answer::where("timeidea_id", "=", $timeidea_id)->delete();
		$poll_id = $timeidea->poll_id;
		$timeidea->delete();

		Answer::where("timeidea_id", "=", $timeidea_id)->delete();
		return Redirect::action('PollController@edit',['id'=>$poll_id])->with('success','Ajankohta on poistettu kyselystä');
	}
}
