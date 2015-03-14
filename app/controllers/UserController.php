<?php

class UserController extends \BaseController {
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (!Auth::user())
			return Redirect::to('login')->withErrors('Pooli näkyy vain kirjautuneille');
		
		$users = User::all();
    		return View::make('user.index', array('users' => $users));
	}

	public function active()
	{
		if (!Auth::user()) {
			return Redirect::to('login')->withErrors('Pooli näkyy vain kirjautuneille');		
		}
		$users = User::where('is_active', '=', true)->get();
    	return View::make('user.index', array('users' => $users));
	}

	public function inactive()
	{
		if (!Auth::user()) {
			return Redirect::to('login')->withErrors('Pooli näkyy vain kirjautuneille');
		}
		$users = User::where('is_active', '=', false)->get();
    	return View::make('user.index', array('users' => $users));
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
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		if(Auth::user()->is_admin) {
			$polls = Poll::where('is_open', '=', 1)->get(); 
			$committees = Committee::where('is_open', '=', 1)->get();
		}
		else {
			$polls = [];
			$committees = [];
			foreach(Auth::user()->polls as $poll)
				if($poll->is_open) array_push($polls, $poll);
			foreach(Auth::user()->committees as $committee)
				if($committee->is_open) array_push($committees, $committee);
		}
		return View::make('user.show', array('polls' => $polls, 'committees' => $committees));
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
