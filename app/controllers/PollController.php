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
}
