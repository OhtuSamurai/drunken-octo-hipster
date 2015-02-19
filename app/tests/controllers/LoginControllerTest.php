<?php

class LoginControllerTest extends TestCase {

	public function testShowLoginPage() {
		$response = $this->action('GET', 'LoginController@showLoginPage');

		$view = $response->original;
		$a = new LoginController;
		$this->assertEquals($a->showLoginPage(), $view );
	}

	public function testLoginAndLogout() {
		$params = ['id' => 42, 'first_name' => 'f', 'last_name' => 'l', 'department' => 'deb', 'position' => 'pos', 'username' => 'tiina'];
		$this->mockUser($params)->save();

		$a = new LoginController;
		$this->assertNull(Auth::user());

		Request::replace($input=['username'=>'tiina']);
		$a->doLogin();

		$this->assertNotNull(Auth::user());
		$this->assertEquals('tiina', Auth::user()->username);

		$a->logout();
		$this->assertNull(Auth::user());
	}

	public function testCantLoginWithInvalidUsername() {
		$a = new LoginController;

		Request::replace($input=['username'=>'godzilla']);

		$response = $this->action('POST', 'LoginController@doLogin');
		$view = $response->original;
		$this->assertEquals($a->doLogin(), $view );

		$this->assertNull(Auth::user());
	}

}