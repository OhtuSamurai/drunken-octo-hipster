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

	  $polls = Poll::where('is_open','=',1)->get(); 	  
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
		$users = User::where('is_active', '=', true)->get();
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
    	$poll->id = $this->random_path();
    	$poll->save();
    	return $poll;
	}

	/**
	* Creates a random string with the lengt of 15
	*
	* @return string
	*/
	private function random_path()
	{
		$path = "";
		$poss = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		for($i = 0; $i<15; $i++) {
			$n = rand(0, strlen($poss)-1);
			$path .= $poss[$n];
		}
		return $path;
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
   		if (!Input::has('user'))
    			return Redirect::route('poll.create')->withErrors("Valitse ensin käyttäjiä listasta");
		if ($this->validate()->fails())
			return Redirect::route('poll.create')->withErrors($this->validate());
		$poll = $this->makeAndSaveAPoll();
    	foreach(Input::get('user') as $user)
      		$poll->users()->attach($user);
    	return Redirect::route('poll.edit', array('poll' => $poll->id))->with('success','Kyselyn tallennus onnistui!');
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
		$comments = $poll->comments;
		$lurkers = $poll->lurkers;
		return View::make('poll.show', array('poll' => $poll, 'users' => $users, 'timeideas' => $timeideas,
			'answers' => $answers, 'comments' => $comments, 'lurkers' => $lurkers));
	}
	
/*	Mihin tätä funktiota tarvitaan?
	private function userInCommittee($user_id,$committee_id) {
		foreach(Committee::find($committee_id)->users as $user)
			if ($user->id==$committee_id)
				return true;
		return false;
	} */

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$poll = Poll::find($id);
		return View::make('poll.edit', ['poll' => $poll]);
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
		if(Input::has('is_open') AND !Input::has('user'))
			return Redirect::action('PollController@show', ['id' => $id])->withErrors('Valitse ensin käyttäjiä');
		if(Input::has('is_open') AND !Input::has('time'))
			return Redirect::action('PollController@show', ['id' => $id])->withErrors('Valitse ajankohta');
		$poll = Poll::find($id);
		
		foreach (Input::all() as $key => $value)
		{
			if( array_key_exists($key, $poll->toArray() ))
				$poll->$key = $value;
		}
		$poll->save();

		//if poll is_open changes, method will create new committee from poll
		if( Input::has('is_open') )
		{			
			$committee = new Committee;
			$committee->name = $poll->toimikunta;
			$committee->time = Input::get('time');
			$committee->save();
			foreach(Input::get('user') as $user)
				$committee->users()->attach($user);
		return Redirect::route('committee.show', array('poll' => $committee->id));
		}

		//for example if polls name gets changed
		return Redirect::route('poll.edit', array('id' => $id))->with('success','Kyselyn tiedot on tallennettu!');
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
