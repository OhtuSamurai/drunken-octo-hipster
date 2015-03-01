<?php

class CommitteeController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$committees = Committee::all(); 	  
		return View::make('committee.index', array('committees' => $committees));
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
		$poll_id = Input::get('poll_id');
		$poll = Poll::find($poll_id);
		
		$committee = new Committee;
		$committee->name = $poll->toimikunta;
		$committee->time = Input::get('time');
		$committee->save();

		if(!empty($poll->users))
			foreach($poll->users as $user)
				$committee->users()->attach($user);
		return Redirect::route('committee.show', array('poll' => $committee->id));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$committee = Committee::find($id);
    	
    	$users = $committee->users;
		
		return View::make('committee.show', array('committee' => $committee, 'users' => $users));
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
