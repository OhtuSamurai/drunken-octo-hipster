<?php

class LoginControllerTest extends TestCase {

	public function testShowLoginPage() {
		$response = $this->action('GET', 'LoginController@showLoginPage');

		$view = $response->original;
		$login_ctrl = new LoginController;
		$this->assertEquals($login_ctrl->showLoginPage(), $view );
	}

	public function testLoginAndLogout() {
		$params = ['id' => 42, 'first_name' => 'f', 'last_name' => 'l', 'department' => 'deb', 'position' => 'pos', 'username' => 'tiina'];
		$this->mockUser($params)->save();

		$login_ctrl = new LoginController;
		$this->assertNull(Auth::user());

		Request::replace($input=['username'=>'tiina']);
		$login_ctrl->doLogin();

		$this->assertNotNull(Auth::user());
		$this->assertEquals('tiina', Auth::user()->username);

		$login_ctrl->logout();
		$this->assertNull(Auth::user());
	}

	public function testCantLoginWithInvalidUsername() {
		Request::replace($input=['username'=>'godzilla']);

		$this->action('POST', 'LoginController@doLogin');
		
		$this->assertRedirectedTo('login');
		$this->assertSessionHasErrors();
		$this->assertNull(Auth::user());
	}

}