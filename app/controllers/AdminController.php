<?php

class AdminController extends Controller {

	public function showAdminPage()
	{
		$committees = Committee::all();
		$polls = Poll::all(); 	  
		return View::make('admin.index', array('polls' => $polls, 'committees' => $committees));
	}
}
