<?php

class PollController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
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
 	   //
  	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$poll = new Poll;
    	$poll->toimikunta = Input::get('toimikunta');
    	$poll->is_open = 1;
    	
    	$poll->save();

    	$users = Input::get('user');
	if (!empty($users))
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
		$poll = Poll::find($id);

		foreach (Input::all() as $key => $value) {
			if( array_key_exists($key, $poll->toArray() ))
				$poll->$key = $value;
		}

		$poll->save();
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
