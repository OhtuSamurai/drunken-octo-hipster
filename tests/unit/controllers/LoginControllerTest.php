<?php

class LoginControllerTest extends TestCase {

	public function testShowLoginPage() {
		$this->action('GET', 'LoginController@showLoginPage');
		$this->assertResponseOk();
	}

	public function testLoginAndLogout() {
		$params = ['id' => 42, 'first_name' => 'f', 'last_name' => 'l', 'department' => 'deb', 'position' => 'pos', 'username' => 'tiina'];
		$this->mockUser($params)->save();
		$this->assertNull(Auth::user());
		$this->action('POST', 'LoginController@login', null, ['username'=>'tiina']);
		$this->assertNotNull(Auth::user());
		$this->assertEquals('tiina', Auth::user()->username);
		$this->action('GET', 'LoginController@logout');
		$this->assertRedirectedTo('/');
		$this->assertNull(Auth::user());
	}

	public function testCantLoginWithoutUsername() {
		$this->action('POST', 'LoginController@login');
		$this->assertRedirectedTo('login');
		$this->assertSessionHasErrors('username');
		$this->assertNull(Auth::user());
	}

	public function testLoginWithIncorrectUsername() {
		$this->action('POST', 'LoginController@login', null, ['username' => "typo"]);
		$this->assertRedirectedToAction('LoginController@login');
		$this->assertSessionHasErrors();
		$this->assertNull(Auth::user());
	}
}