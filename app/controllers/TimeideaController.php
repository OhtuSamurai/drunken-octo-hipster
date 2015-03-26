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
	* Creates a new Model of Timeidea
	*
	* @return Timeidea
	*/
	private function makeTimeideaOfInput() {
		$timeidea = new Timeidea;
		$timeidea->poll_id = Input::get('poll_id');
		$timeidea->description = Input::get('description');
		return $timeidea;
	}

	/*
	* Creates a single new answer
	*
	*/
	private function createAnswer($uid, $timeideaid, $column) {
		$answer = new Answer;
		$answer->$column = $uid;
		$answer->timeidea_id = $timeideaid;
		$answer->sopivuus = 'eivastattu';
		$answer->save();
	}

	/*
	* Creates answers for a single timeidea
	*
	*/
	private function setAnswers($poll,$timeideaid) {
		foreach($poll->users as $user) {
			$this->createAnswer($user->id, $timeideaid, "participant_id");
		}
		foreach($poll->lurkers as $lurker) {
			$this->createAnswer($lurker->id, $timeideaid, "lurker_id");
		}
	}

	/**
  	* Sets Validator arguments and returns an instance of Validator
  	* 
  	* @return Validator
  	*/
  	private function validate() {
  		$rules = array('description'=>'required|min:1');		
		$messages = ['required'=>'Yritit lisätä tyhjän ajankohdan'];
		return Validator::make(Input::all(),$rules,$messages);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(!Auth::check() or !Auth::User()->is_admin)
			return Redirect::route('poll.show', array('poll'=>Input::get('poll_id')))->withErrors("Toiminto evätty!");

		$validation = $this->validate();
		if($validation->fails())
			return Redirect::route('poll.show', array('poll'=>Input::get('poll_id')))->withErrors($validation);

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
