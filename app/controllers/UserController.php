<?php

class UserController extends \BaseController {

	/**
	 * Show the list containing active users
	 *
	 * @return Response
	 */
	public function active()
	{
		if (!Auth::user()) {
			return Redirect::to('login')->withErrors('Pooli näkyy vain kirjautuneille');		
		}
		$users = User::where('is_active', '=', true)->get();
		return View::make('user.index', array('users' => $users));
	}

	/**
	 * Show the list containing inactive users
	 *
	 * @return Response
	 */
	public function inactive()
	{
		if (!Auth::user()) {
			return Redirect::to('login')->withErrors('Pooli näkyy vain kirjautuneille');
		}
		$users = User::where('is_active', '=', false)->get();
		return View::make('user.inactive', array('users' => $users));
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
		return View::make('user.create', array('user' => new User));	
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(!Auth::check() or !Auth::User()->is_admin){
			return Redirect::to('/')->withErrors("Toiminto evätty!");
		}

		$user = new User;
		$user->username = Input::get('username');
		$user->first_name = Input::get('first_name');
		$user->last_name = Input::get('last_name');
		$user->email = Input::get('email');
		$user->department = Input::get('department');
		$user->position = Input::get('position');
		$user->description = Input::get('description');
		$user->is_active = false;

		$validator = $user->validator();
		if ($validator->fails()) {
			return Redirect::action('UserController@create')->withErrors($validator)->withInput(Input::all());
		}
		$user->save();
		return Redirect::action('UserController@inactive')->with('success', "Käyttäjä ".$user->username." on luotu järjestelmään.");
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::find($id);
		if($user->is_admin) {
			$polls = Poll::where('is_open', '=', 1)->get(); 
			$committees = Committee::where('is_open', '=', 1)->get();
		}
		else 
		{
			$polls = [];
			$committees = [];
			foreach($user->polls as $poll)
				if($poll->is_open) array_push($polls, $poll);
			foreach($user->committees as $committee)
				if($committee->is_open) array_push($committees, $committee);
		}
	
		$showUnanswered = false;
		$uapolls = array();
		if (Auth::user() && !Auth::user()->is_admin && $id==Auth::user()->id &&count(Auth::user()->unansweredpolls())>0) {
			$showUnanswered=true;
			$uapolls = $this->createArrayOfUnAnsweredPolls();
		}
		
		return View::make('user.show', 
			array('user' => $user, 'polls' => $polls, 'committees' => $committees, 'showUnanswered'=>$showUnanswered,'uapolls'=>$uapolls,
				'curr' => count($user->curr_committees()), 'evry' => count($user->committees), 'currp' => count($user->curr_polls()), 'evryp' =>count($user->polls)));
	}

	private function createArrayOfUnAnsweredPolls() {
		$res = array();
		foreach (array_unique(Auth::user()->unansweredpolls()) as $uapollid)
			array_push($res,Poll::find($uapollid));
		return $res;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if(!Auth::check() || (!Auth::user()->is_admin && Auth::user()->id != $id)) {
			return Redirect::to('/')->withErrors("Toiminto evätty!");
		}
		$user = User::find($id);
		return View::make('user.edit', array('user' => $user));	
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if(!Auth::check() || (!Auth::user()->is_admin && Auth::user()->id != $id)) {
			return Redirect::to('/')->withErrors("Toiminto evätty!");
		}
		if(Input::has('is_admin') and (Auth::user()->is_admin AND Auth::user()->id == $id))
			return Redirect::action('UserController@show', $id)->withErrors('Et voi poistaa admin oikeuksiasi');
		$user = User::find($id);
		foreach (Input::all() as $key => $value)
		{
			if( array_key_exists($key, $user->toArray() ))
				$user->$key = $value;
		}
		$validator = $user->validator();
		if ($validator->fails()) {
			return Redirect::action('UserController@edit', $id)->withErrors($validator)->withInput(Input::all());
		}

		$user->save();
		return Redirect::action('UserController@show', $id)->with('success', "Käyttäjän tiedot päivitetty.");	
	}
	
	public function removeFromPool(){
		if(!Auth::check() or !Auth::User()->is_admin)
			return Redirect::to('/')->withErrors("Toiminto evätty!");
   		if (!Input::has('user'))
    			return Redirect::action('UserController@active')->withErrors("Valitse ensin käyttäjiä listasta");
    	foreach(Input::get('user') as $id){
    		$user = User::find($id);
    		$user->is_active = false;    		
      		$user->save();
      	}
    	return Redirect::action('UserController@active')->with('success', "Käyttäjä/t on poistettu poolista.");
	}
	
	public function addToPool(){
		if(!Auth::check() or !Auth::User()->is_admin)
			return Redirect::to('/')->withErrors("Toiminto evätty!");
   		if (!Input::has('user'))
    			return Redirect::action('UserController@inactive')->withErrors("Valitse ensin käyttäjiä listasta");
    	foreach(Input::get('user') as $id){
    		$user = User::find($id);
    		$user->is_active = true;
      		$user->save();
      	}
    	return Redirect::action('UserController@inactive')->with('success', "Käyttäjä/t on lisätty pooliin.");
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
	
	
	public function delete()
	{
		if(!Auth::check() or !Auth::User()->is_admin)
			return Redirect::to('/')->withErrors("Toiminto evätty!");
		if (!Input::has('user'))
   			return Redirect::action('UserController@inactive')->withErrors("Valitse ensin käyttäjiä listasta");
    	foreach(Input::get('user') as $id){
    		$user = User::find($id);
    		$user->delete();
    	}
    	return Redirect::action('UserController@inactive')->with('success', "Käyttäjä/t on poistettu tietokannasta.");
	}

}
