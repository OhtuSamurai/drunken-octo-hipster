<?php

class LoginController extends Controller {

	private function validate() {
  		$rules = array('username'=>'required|min:1');
		$messages = array('required'=>'Virheellinen käyttäjätunnus');
		return Validator::make(Input::all(),$rules,$messages);
	}

	public function showLoginPage()
	{
		return View::make('login.login');
	}

	public function doLogin()
	{
		$validation = $this->validate();
		$username = Input::get('username');
		$user = User::where('username', $username)->first();
		if ($user == null OR $validation->fails()) {
			return Redirect::action('LoginController@showLoginPage')->withErrors('Virheellinen käyttäjätunnus: '.$username);
		}
		Auth::login($user);
		return Redirect::action('UserController@show', array('id' => $user->id));
	}

	public function logout()
	{
		Auth::logout();
		return Redirect::action('CommitteeController@index');
	}

}
