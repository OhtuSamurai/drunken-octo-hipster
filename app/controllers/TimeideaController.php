<?php

class TimeideaController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function makeTimeideaOfInput() {
		$timeidea = new Timeidea;
		$timeidea->poll_id = Input::get('poll_id');
		$timeidea->date = date("Y-m-d", strtotime( Input::get('date') ) );
		$timeidea->begins = Input::get('begins');
		$timeidea->ends = Input::get('ends');
		return $timeidea;
	}
	public function setAnswers($poll,$timeideaid) {
		foreach($poll->users as $user) {
			$answer = new Answer;
			$answer->participant_id = $user->id;
			$answer->timeidea_id = $timeideaid;
			$answer->sopivuus = 'eisovi';
			$answer->save(); 
		}
	}

	public function store()
	{
		$timeidea = $this->makeTimeideaOfInput();
		$timeidea->save();
		$poll = Poll::find($timeidea->poll_id);
		$this->setAnswers($poll,$timeidea->id);
		return Redirect::route('poll.show', array('poll' => $timeidea->poll_id));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$timeidea = Timeidea::find($id);
		return View::make('timeidea.show', array('timeidea' => $timeidea));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
