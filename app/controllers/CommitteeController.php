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


	private function updateAttachments($committee_id) {
		foreach(Committee::find($committee_id)->attachments as $attachment) {
			if (!file_exists($attachment->file)) {
				$attachment->users()->detach();
				$attachment->delete();
			}
		}
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
		return View::make('committee.create', array('users' => $users));
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
			return Redirect::action('CommitteeController@create')->withErrors("Valitse ensin käyttäjiä listasta");
		$committee = new Committee;
		$committee->name = Input::get('name');
		$committee->time = Input::get('time');
		$committee->save();
		foreach(Input::get('user') as $user)
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
		/* A careful reader might note that we use $id in updateAttachments function to query a committee, which we do again on the very next line. This is intentional, because if we first find a committee and then pass it to updateAttachments, laravel will load the attachments before updating them. This would lead to displaying non-existant attachments on the first time show is called after removing files from the filesystem by hand*/
		$this->updateAttachments($id);
		$committee = Committee::find($id);
    		$users = $committee->users;
		if (!Auth::user())
			$showfiles=false;
		else $showfiles=$this->showFiles($id,Auth::user()->id);
		return View::make('committee.show',
			array('committee' => $committee, 'users' => $users,'showFiles'=>$showfiles, 'comments' => $committee->comments));
	}

	private function showFiles($committee_id,$user_id) {
		foreach(Committee::find($committee_id)->users as $user)
			if ($user->id == $user_id)
				return true;
		return false;
	}

	/**
	 * Marks an open committee as closed and marks a closed committee as open.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function toggleOpen($id)
	{
		if(!Auth::check() or !Auth::User()->is_admin){
			return Redirect::to('/')->withErrors("Toiminto evätty!");
		}
		$committee = Committee::find($id);
		$committee->is_open = !$committee->is_open;
		$committee->save();
		return Redirect::route('committee.show', array('committee' => $id));
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
