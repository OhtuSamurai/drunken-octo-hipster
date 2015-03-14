<?php

class PollController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	  if (!Auth::user() OR !Auth::user()->is_admin)
		return Redirect::to('login')->withErrors('Kyselyt näkyvät vain adminille');

	  $polls = Poll::all(); 	  
	  return View::make('poll.index', array('polls' => $polls));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(!Auth::check() or !Auth::User()->is_admin){
			return Redirect::to('/')->withErrors("Toiminto evätty!");
		}
		$users = User::all();
		return View::make('poll.create', array('users' => $users));
  	}

  	/**
  	* Sets Validator arguments and returns an instance of Validator
  	* 
  	* @return Validator
  	*/
  	private function validate() {
  		$rules = array('toimikunta'=>'required|min:1');
		$messages = array('required'=>'Anna toimikunnalle nimi');
		return Validator::make(Input::all(),$rules,$messages);
	}

	/**
	* Creates and instance of Poll, saves it and lastly returns it
	*
	* @return Poll
	*/
	private function makeAndSaveAPoll() {
		$poll = new Poll;
    	$poll->toimikunta = Input::get('toimikunta');
    	$poll->save();
    	return $poll;
	}	

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(!Auth::check() or !Auth::User()->is_admin)
			return Redirect::to('/')->withErrors("Toiminto evätty!");

		$users = Input::get('user');
   		if (empty($users)) {
    		return Redirect::back()->withErrors("Valitse ensin käyttäjiä listasta");
    	}

		$validation = $this->validate();
		if ($validation->fails())
			return Redirect::back()->withErrors($validation);

		$poll = $this->makeAndSaveAPoll();
    	foreach($users as $user)
      		$poll->users()->attach($user);

    	return Redirect::route('poll.show', array('poll' => $poll->id));
    }


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$poll = Poll::find($id);
    	
    	$users = $poll->users;
		
		$timeideas = $poll->timeideas;
		$answers = $poll->answers;
		
		return View::make('poll.show', array('poll' => $poll, 'users' => $users, 'timeideas' => $timeideas, 'answers' => $answers));
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
		if(!Auth::check() or !Auth::User()->is_admin)
			return Redirect::route('poll.show', array('poll' => $id));
		$poll = Poll::find($id);
		
		foreach (Input::all() as $key => $value) {
			if( array_key_exists($key, $poll->toArray() ))
				$poll->$key = $value;
		}
		$poll->save();

		//if poll is_open changes, method will create new committee from poll
		if( array_key_exists('is_open', Input::all())) {			
			$committee = new Committee;
			$committee->name = $poll->toimikunta;
			$committee->time = Input::get('time');
			$committee->save();
			foreach($poll->users as $user)
				$committee->users()->attach($user);
		return Redirect::route('committee.show', array('poll' => $committee->id));
		}

		//for example if polls name gets changed
		return Redirect::route('poll.show', array('poll' => $id));
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
