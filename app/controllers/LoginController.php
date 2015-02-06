<?php

class LoginController extends Controller {

	public function showLoginPage()
	{
		return View::make('login.login');
	}

	public function doLogin()
	{
		$username = Input::get('username');
		$user = User::where('username', $username)->first();
		if ($user == null) {
			return View::make('login.login');
		}
		Auth::login($user);
		return Redirect::action('UserController@index');
	}

	public function logout()
	{
		Auth::logout();
		return Redirect::action('UserController@index');
	}

}
