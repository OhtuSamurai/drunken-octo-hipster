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
	$closed = Poll::where('is_open','=',0)->get();
	  return View::make('poll.index', array('polls' => $polls,'closed'=>$closed));
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

	/**
	* Adds a user to a poll
	*
	*/
	private function addUserToPoll($poll, $userid)
	{
		$poll->users()->attach($userid);
		$poll->save();
		foreach($poll->timeideas as $timeidea) {
			AnswerController::createAnswer($userid, $timeidea->id, "participant_id");
		}
	}

	/**
	* Removes a user from a poll
	*
	*/
	private function removeUserFromPoll($poll, $userid)
	{
		foreach($poll->timeideas as $timeidea){
			Answer::where("participant_id", "=", $userid)->where("timeidea_id", "=", $timeidea->id)->delete();
		}
		$poll->users()->detach($userid);
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
		$showAdvice = false;
		if ((Auth::user() && !Auth::user()->is_admin && in_array($id,Auth::user()->unansweredpolls()))||!Auth::user())
			$showAdvice=true;
		return View::make('poll.show', array('poll' => $poll, 'users' => $users, 'timeideas' => $timeideas,
			'answers' => $answers,'showAdvice'=>$showAdvice, 'comments' => $comments, 'lurkers' => $lurkers));
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$users = User::where('is_active', '=', true)->get();
		$poll = Poll::find($id);
		return View::make('poll.edit', ['poll' => $poll, 'users' => $users]);
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
		if(!Input::has('user'))
			return Redirect::action('PollController@edit', ['id' => $id])->withErrors('Valitse ensin käyttäjiä');
		$poll = Poll::find($id);
		$poll->toimikunta = Input::get('toimikunta');
		$poll->description = Input::get('description');

		//list of users in poll before making changes
		$userlist = $poll->users->lists('id');

		//remove unselected users from poll
		foreach($userlist as $user) {
			if (!in_array($user, Input::get('user'))){
				$this->removeUserFromPoll($poll, $user);
			}
		}

		//add new selected users to poll
		foreach(Input::get('user') as $user){
			if (!in_array($user, $userlist)){
				$this->addUserToPoll($poll, $user);
			}
		}

		$poll->save();
		return Redirect::route('poll.edit', array('id' => $id))->with('success','Kyselyn tiedot on tallennettu!');
	}

	/**
	 * Toggles the 'is_open' state of a poll
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function toggleOpen($id) {
		if(!Auth::check() or !Auth::User()->is_admin){
			return Redirect::to('/')->withErrors("Toiminto evätty!");
		}
		$poll = Poll::find($id);
		$poll->is_open = !$poll->is_open;
		$poll->save();
		return Redirect::route('poll.show', array('id' => $id));
	}

	/**
	 * Creates a committee from a poll
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function makeACommittee($id) {
		if(!Auth::check() or !Auth::User()->is_admin)
			return Redirect::route('poll.show', array('poll' => $id));
		if (!Input::has('time'))
			return Redirect::action('PollController@show', ['id' => $id])->withErrors('Valitse ajankohta');
		if (!Input::has('user'))
			return Redirect::route('poll.create')->withErrors("Valitse ensin käyttäjiä listasta");
		$poll = Poll::find($id);
		$committee = new Committee;
		$committee->name = $poll->toimikunta;
		$committee->time = Input::get('time');
		$committee->save();
		foreach(Input::get('user') as $user)
			$committee->users()->attach($user);
		return Redirect::route('committee.show', array('poll' => $committee->id));
	}

	/**
	 * Makes a copy of an existing poll
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function makeACopy($id)
	{
		if(!Auth::check() or !Auth::User()->is_admin){
			return Redirect::to('/')->withErrors("Toiminto evätty!");
		}
		$old_poll = Poll::find($id);
		$poll = new Poll;
		$poll->toimikunta = $old_poll->toimikunta." (kopio)";
		$poll->description = $old_poll->description;
		$poll->id = $this->random_path();
		$poll->save();
		foreach($old_poll->timeideas as $old_timeidea) {
			$timeidea = new Timeidea;
			$timeidea->description = $old_timeidea->description;
			$timeidea->poll_id = $poll->id;
			$timeidea->save();
		}

		return Redirect::route('poll.edit', array('id' => $poll->id))->with('success','Kopiointi onnistui. Voit nyt lisätä kyselyyn uusia käyttäjiä.');
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
