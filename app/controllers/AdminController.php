<?php

class AdminController extends Controller {

	public function showAdminPage()
	{
		$committees = Committee::all();
		$polls = Poll::where('is_open', '=', 1)->get();
		return View::make('admin.index', array('polls' => $polls, 'committees' => $committees));
	}
}
