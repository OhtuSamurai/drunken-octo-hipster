<?php

class TemplateController extends BaseController
{
  /**
   * Controller for handling test template
   */
  public function template() {
    $users = User::all();
	$timeideas = Timeidea::all();
    return View::make('template', array('users' => $users,'timeideas'=>$timeideas));
  }

}       
