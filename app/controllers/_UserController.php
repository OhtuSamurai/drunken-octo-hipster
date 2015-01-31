<?php

class UserController extends BaseController
{
  /**
   * Controller for handling users-table
   * authored: mihassin
   */
  public function pooli() {
    $users = User::all();
    return View::make('pooli.pooli', array('users' => $users));
  }

}
