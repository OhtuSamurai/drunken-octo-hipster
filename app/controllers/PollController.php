<?php

class PollController extends BaseController
{
  /**
   * Controller for handling test template
   */
  public function template() {
    $users = User::all();
	  $timeideas = Timeidea::all();
    return View::make('template', array('users' => $users,'timeideas'=>$timeideas));
  }

  public function list_polls() {
    $polls = Poll::all();
    return View::make('polls', array('polls' => $polls));
  }
<<<<<<< HEAD

  public function create() {
    return Redirect::to('pooli');
  }
=======
	public function show_poll($id) {
		$poll = Poll::find($id);
		return View::make('poll', array('poll' => $poll));
>>>>>>> 5ff79b660f0bc5d9819083a6d778169c65b0cb6b
}
