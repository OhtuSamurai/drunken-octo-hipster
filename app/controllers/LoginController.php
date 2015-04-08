<?php

class LoginController extends Controller {

	private function validate() {
  		$rules = array('username'=>'required|min:1');
		$messages = array('required'=>'Et kirjoittanut käyttäjätunnustasi');
		return Validator::make(Input::all(),$rules,$messages);
	}

	public function showLoginPage()
	{
		return View::make('login.login');
	}

	public function login()
	{
		if($this->validate()->fails()) 
			return Redirect::action('LoginController@showLoginPage')->withErrors($this->validate());
		$user = User::where('username', '=',Input::get('username'))->first();
		if ($user == null)
			return Redirect::action('LoginController@showLoginPage')->withErrors('Virheellinen käyttäjätunnus');
		Auth::login($user);
		return Redirect::action('UserController@show', array('id' => $user->id))->with('success', 'Tervetuloa '.$user->first_name.'!');
	}

	public function logout()
	{
		Auth::logout();
		return Redirect::to('/')->with('success', 'Uloskirjautuminen onnistui!');
	}
}
