<?php

class PollControllerTest extends TestCase {
	
	public function testIndex() {
		$this->action('GET', 'PollController@index');
		$this->assertRedirectedToAction('LoginController@showLoginPage');
		$this->assertSessionHasErrors();
	}

	public function testIndexWithLoggedInUser() {
		$this->fakeLoginUser();
		$this->testIndex();
	}

	public function testIndexWithAdmin() {
		$this->fakeLoginAdmin();
		$this->action('GET', 'PollController@index');
		$this->assertResponseOk();
		$this->assertViewHas('polls');
	}

	public function testCreate() {
		$this->action('GET','PollController@create');
		$this->assertRedirectedTo('/');
		$this->assertSessionHasErrors();
	}
	
	public function testCreateAdmin() {
		$this->fakeLoginAdmin();
		$this->action('GET', 'PollController@create');
		$this->assertResponseOk();
		$this->assertViewHas('users');	
	}
	
	public function testStoreNotLoggedIn() {
		$this->action('POST', 'PollController@store');
		$this->assertRedirectedTo('/');
	}

	public function testStoreWithRegularUser() {
		$this->fakeLoginUser();//auth on sessiossa, siksi seuraava rivi toimii
		$this->testStoreNotLoggedIn();
	}	

	public function testStoreWithMissingInput() {
		$this->fakeLoginAdmin();
		$this->action('POST', 'PollController@store');
		$this->assertRedirectedToAction('PollController@create');
		$this->assertSessionHasErrors();
	}

	public function testStoreWithMissingUsersInput() {
		$this->fakeLoginAdmin();
		$this->action('POST', 'PollController@store', null, ['user' => [1]]);
		$this->assertRedirectedToAction('PollController@create');
		$this->assertSessionHasErrors('toimikunta');
	}

	public function testStore() {
		$this->fakeLoginAdmin();
		$params = ['id' => 42, 'first_name' => 'f', 'last_name' => 'l', 'department' => 'deb', 'position' => 'pos', 'username' => 'usr'];
		for($i = 51; $i<54; $i++) {
			$params['id'] = $i;
			$this->mockUser($params)->save();
		}
		$this->action('POST', 'PollController@store', null, ['toimikunta'=>'Hieno Toimikunta', 'user'=>[51, 52]]);
		$poll = Poll::find(1);
		$this->assertEquals(1, $poll->is_open);
		$this->assertEquals('Hieno Toimikunta', $poll->toimikunta);
		$this->assertTrue($poll->users()->get()->contains(51));
		$this->assertTrue($poll->users()->get()->contains(52));
		$this->assertFalse($poll->users()->get()->contains(53));
	}
	
	public function testShow() {
		$this->mockPoll()->save();
		$this->action('GET', 'PollController@show', ['id' => 43]);
		$this->assertViewHas('users');
		$this->assertViewHas('timeideas');
		$this->assertViewHas('answers');
	}

	public function testEdit() {
		$this->mockPoll()->save();
		$this->action('GET', 'PollController@edit', ['id' => 43]);
		$this->assertViewHas('poll');
	}
	
	public function testUpdate() {
		$this->fakeLoginAdmin();
		$this->mockPoll()->save();
		$poll = Poll::find(43);
		$this->action('PUT', 'PollController@update', ['id' => $poll->id], ['toimikunta' => 'bricks']);
		$this->assertRedirectedToAction('PollController@show', ['id' => $poll->id]);
		$this->assertEquals('bricks', Poll::find(43)->toimikunta);
	}

	private function updateIsOpen($cred, $expected) {
		$this->fakeLoginAdmin();
		$poll = $this->mockPoll();
		$poll->save();
		$this->assertEquals(1, $poll->is_open);
		$this->action('PUT','PollController@update', ['id' => $poll->id], $cred);
		$this->assertEquals($expected, Poll::find(43)->is_open);
	}

	public function testUpdateIsOpenWithoutInput() {
		$this->updateIsOpen(['is_open'=>false], 1);
	}

	public function testUpdateIsOpenWithTimeideaButWithoutUser() {
		$this->updateIsOpen(['is_open'=>false, 'time'=>'joskus'], 1);
	}

	public function testUpdateIsOpenWithUserButWithoutTimeidea() {
		$this->updateIsOpen(['is_open'=>false, 'user'=>[1]], 1);
	}

	public function testUpdateIsOpen() {
		$this->updateIsOpen(['is_open'=>false, 'time'=>'Joskus', 'user'=>[1]], 0);
	}

	public function testDestroy() {
		$poll_ctrl = new PollController;
		$this->assertNull($poll_ctrl->destroy(1));
	}
}