<?php

class UserControllerTest extends TestCase {

	/*public function testIndex() {
		$this->fakeLoginUser();
		$response = $this->action('GET', 'UserController@index');

		$view = $response->original;
		$usr_ctrl = new UserController;
		$this->assertEquals($usr_ctrl->index(), $view );
	}*/

	public function testActive() {
		$this->fakeLoginUser();
		$this->action('GET', 'UserController@active');
		$this->assertResponseOk();
	}

	public function testActiveAsNotLoggedIn() {
		$this->action('GET', 'UserController@active');
		$this->assertSessionHasErrors();
		$this->assertRedirectedToAction('LoginController@showLoginPage');
	}

	public function testInactive() {
		$this->fakeLoginUser();
		$this->action('GET', 'UserController@inactive');
		$this->assertResponseOk();	
	}

	public function testInactiveAsNotLoggedIn() {
		$this->action('GET', 'UserController@inactive');
		$this->assertSessionHasErrors();
		$this->assertRedirectedToAction('LoginController@showLoginPage');
	}

	public function testShow() {
		$this->fakeLoginUser();

		$poll = $this->mockPoll();
		$poll->save();
		$poll->users()->attach(User::find(42));
		$close_poll = $this->mockPoll();
		$close_poll->id = 99;
		$close_poll->is_open = 0;
		$close_poll->save();
		$close_poll->users()->attach(User::find(42));

		$committee = $this->mockCommittee();
		$committee->save();
		$committee->users()->attach(User::find(42));
		$close_committee = $this->mockCommittee();
		$close_committee->id = 99;
		$close_committee->is_open = 0;
		$close_committee->save();
		$close_committee->users()->attach(User::find(42));

		$response = $this->action('GET', 'UserController@show', array('id' => 42));

		$view = $response->original;
		$usr_ctrl = new UserController;
		$this->assertEquals($usr_ctrl->show(42), $view );
		$this->assertViewHas("polls");
		$this->assertViewHas("curr", 1);
		$this->assertViewHas("evry", 2);
		$this->assertViewHas("currp", 1);
		$this->assertViewHas("evryp", 2);		
	}

	public function testShowWithAdmin() {
		$this->fakeLoginAdmin();
		$response = $this->action('GET', 'UserController@show', array('id' => 123));

		$view = $response->original;
		$usr_ctrl = new UserController;
		$this->assertEquals($usr_ctrl->show(123), $view );		
	}

	public function testCreateNotLoggedIn() {
		$response = $this->action('GET', 'UserController@create');
		$this->assertRedirectedTo('/');
		$this->assertSessionHasErrors();
	}

	public function testCreateLoggedInAsRegularUser() {
		$this->fakeLoginUser();
		$this->testCreateNotLoggedIn();
	}

	public function testCreateAsAdmin() {
		$this->fakeLoginAdmin();
		$response = $this->action('GET', 'UserController@create');
		$this->assertResponseOk();
		$this->assertViewHas('user');
	}

	public function testStoreNotLoggedIn() {
		$this->action('POST', 'UserController@store', array('username' => 'iines', 'first_name' => 'Iines', 'last_name' => 'Ankka', 'department' => 'd', 'position' => 'e', 'description' => ''));
		$this->assertRedirectedTo('/');
		$this->assertSessionHasErrors();
		$user1 = User::where('username', 'iines')->first();
		$this->assertNull($user1);
	}

	public function testStoreLoggedInAsRegularUser() {
		$this->fakeLoginUser();
		$this->testStoreNotLoggedIn();
	}

	public function testStoreAsAdmin() {
		$this->fakeLoginAdmin();
		$this->action('POST', 'UserController@store', array('username' => 'iines', 'first_name' => 'Iines', 'last_name' => 'Ankka', 'department' => 'd', 'position' => 'e', 'description' => ''));
		$this->assertRedirectedToAction('UserController@inactive', array(), array('success' => 'Käyttäjä iines on luotu järjestelmään.'));
		$this->action('POST', 'UserController@store', array('username' => 'iines', 'first_name' => 'Iines', 'last_name' => 'Ankka', 'department' => 'd', 'position' => 'e', 'description' => ''));
		$this->assertSessionHasErrors();
	}

	public function testEditNotLoggedIn() {
		$this->mockUserWithId(666)->save();
		$response = $this->action('GET', 'UserController@edit', 666);
		$this->assertRedirectedTo('/');
		$this->assertSessionHasErrors();
	}

	public function testEditLoggedInAsRegularUser() {
		$user = $this->mockUserWithId(667);
		$user->save();
		$this->fakeLogin($user);
		$this->testEditNotLoggedIn();
	}

	public function testEditOwnProfile() {
		$user = $this->mockUserWithId(668);
		$user->save();
		$this->fakeLogin($user);
		$response = $this->action('GET', 'UserController@edit', 668);
		$this->assertResponseOk();
	}

	public function testEditUserAsAdmin() {
		$user = $this->mockUserWithId(669)->save();
		$this->fakeLoginAdmin();
		$response = $this->action('GET', 'UserController@edit', 669);
		$this->assertResponseOk();
	}

	public function testUpdateNotLoggedIn() {
		$user = $this->mockUserWithId(670);
		$user->save();
		$this->action('PUT', 'UserController@update', 670, array('first_name' => 'Iines', 'last_name' => 'Ankka', 'department' => 'd', 'position' => 'e', 'description' => 'ihQ'));
		$this->assertRedirectedTo('/');
		$this->assertSessionHasErrors();
		$user2 = User::find(670);
		$this->assertEquals('', $user2->description);
	}

	public function testUpdateLoggedInAsRegularUser() {
		$user = $this->mockUserWithId(671);
		$user->save();
		$this->fakeLogin($user);
		$this->testUpdateNotLoggedIn();
	}

	public function testUpdateOwnProfile() {
		$user = $this->mockUserWithId(672);
		$user->save();
		$this->fakeLogin($user);
		$this->action('PUT', 'UserController@update', 672, array('first_name' => 'Iines', 'last_name' => 'Ankka', 'department' => 'd', 'position' => 'e', 'description' => 'ihQ'));
		$user2 = User::find(672);
		$this->assertEquals('ihQ', $user2->description);
	}

	public function testUpdateUserAsAdmin() {
		$user = $this->mockUserWithId(673)->save();
		$this->fakeLoginAdmin();
		$this->action('PUT', 'UserController@update', 673, array('first_name' => 'Iines', 'last_name' => 'Ankka', 'department' => 'd', 'position' => 'e', 'description' => 'ihQ'));
		$user2 = User::find(673);
		$this->assertEquals('ihQ', $user2->description);	
	}

	public function testCantLeaveMandatoryFieldEmpty() {
		$user = $this->mockUserWithId(674)->save();
		$this->fakeLoginAdmin();
		$this->action('PUT', 'UserController@update', 674, array('first_name' => '', 'last_name' => 'Ankka', 'department' => 'd', 'position' => 'e', 'description' => 'ihQ'));
		$this->assertRedirectedToAction('UserController@edit', 674);
		$this->assertSessionHasErrors();
		$user2 = User::find(674);
		$this->assertEquals('', $user2->description);	
	}


	public function testDestroy() {
		$usr_ctrl = new UserController;
		$this->assertNull($usr_ctrl->destroy(1));
	}
}