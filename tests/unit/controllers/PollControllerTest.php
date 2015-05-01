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
		$poll = Poll::all()->first();
		$this->assertRedirectedToAction('PollController@edit', ['id' => $poll->id]);
		$this->assertEquals(1, $poll->is_open);
		$this->assertEquals('Hieno Toimikunta', $poll->toimikunta);
		$this->assertTrue($poll->users()->get()->contains(51));
		$this->assertTrue($poll->users()->get()->contains(52));
		$this->assertFalse($poll->users()->get()->contains(53));
	}
	
	public function testShow() {
		$this->mockPoll()->save();
		$this->action('GET', 'PollController@show', ['id' => 'uniikki']);
		$this->assertViewHas('poll');
		$this->assertViewHas('users');
		$this->assertViewHas('timeideas');
		$this->assertViewHas('answers');
		$this->assertViewHas('comments');
		$this->assertViewHas('lurkers');
	}

	public function testEdit() {
		$this->mockPoll()->save();
		$this->action('GET', 'PollController@edit', ['id' => 'uniikki']);
		$this->assertViewHas('poll');
	}
	
	public function testUpdate() {
		$this->fakeLoginAdmin();
		$this->mockPoll()->save();
		$this->mockTimeidea()->save();
		$user = $this->mockUser();
		$user->save();
		$poll = Poll::find('uniikki');
		$this->action('PUT', 'PollController@update', ['id' => $poll->id], ['toimikunta' => 'bricks', 'description' => 'weeee', 'user' => [$user->id]]);
		$this->assertRedirectedToAction('PollController@edit', ['id' => $poll->id]);
		$this->assertEquals('bricks', Poll::find('uniikki')->toimikunta);
		$this->assertEquals('eivastattu', Answer::find(1)->sopivuus);
		$this->assertEquals(42, Answer::find(1)->participant_id);
	}

	public function testUpdateRemoveFromPoll() {
		$this->fakeLoginAdmin();
		$this->mockPoll()->save();
		$this->mockTimeidea()->save();
		$user = $this->mockUser();
		$user->save();
		$poll = Poll::find('uniikki');
		$poll->users()->attach($user);
		$this->action('PUT', 'PollController@update', ['id' => $poll->id], ['toimikunta' => 'chicks', 'description' => 'wuhuu', 'user' => []]);
		$this->assertRedirectedToAction('PollController@edit', ['id' => $poll->id]);
		$this->assertEquals('chicks', Poll::find('uniikki')->toimikunta);
		$this->assertNull(Answer::find(8));
	}

	public function testToggleOpenWithoutLoggingIn() {
		$poll = $this->mockPoll();
		$poll->save();
		$this->assertEquals(1, $poll->is_open);
		$this->action('POST','PollController@toggleOpen', ['id' => $poll->id]);
		$this->assertEquals(1, Poll::find($poll->id)->is_open);
		$this->action('POST','PollController@toggleOpen', ['id' => $poll->id]);
		$this->assertEquals(1, Poll::find($poll->id)->is_open);
	}

	public function testToggleOpenAsAdmin() {
		$this->fakeLoginAdmin();
		$poll = $this->mockPoll();
		$poll->save();
		$this->assertEquals(1, $poll->is_open);
		$this->action('POST','PollController@toggleOpen', ['id' => $poll->id]);
		$this->assertEquals(0, Poll::find($poll->id)->is_open);
		$this->action('POST','PollController@toggleOpen', ['id' => $poll->id]);
		$this->assertEquals(1, Poll::find($poll->id)->is_open);
	}

	public function testMakeCommitteeNotLoggedIn() {
		$this->mockPoll()->save();
		$this->action('POST', 'PollController@makeACommittee', ['id' => 'uniikki']);
		$this->assertRedirectedToAction('PollController@show', ['id' => 'uniikki']);
	}

	public function testMakeCommitteeAsUser() {
		$this->fakeLoginUser();
		$this->testMakeCommitteeNotLoggedIn();
	}

	public function testMakeCommitteeTimeideaMissing() {
		$this->fakeLoginAdmin();
		$this->mockPoll()->save();
		$this->action('POST', 'PollController@makeACommittee', ['id' => 'uniikki']);
		$this->assertRedirectedToAction('PollController@show', ['id' => 'uniikki']);
		$this->assertSessionHasErrors();		
	}

	public function testMakeCommitteeUserMissing() {
		$this->fakeLoginAdmin();
		$this->mockPoll()->save();
		$this->action('POST', 'PollController@makeACommittee', ['id' => 'uniikki'], ['time' => 'asd']);
		$this->assertRedirectedToAction('PollController@show', ['id' => 'uniikki']);
		$this->assertSessionHasErrors();		
	}

	public function testMakeCommittee() {
		$this->fakeLoginAdmin();
		$this->mockPoll()->save();
		$this->mockuser()->save();
		$this->action('POST', 'PollController@makeACommittee', ['id' => 'uniikki'], ['time' => 'asd', 'user' => [42]]);
		$this->assertRedirectedToAction('CommitteeController@show', ['id' => 1]);
		$this->assertEquals('asd', Committee::find(1)->time);
		$this->assertEquals(User::find(42)->username, Committee::find(1)->users->first()->username);
	}

	public function testMakeCopyNotLoggedIn() {
		$this->mockPoll()->save();
		$this->action('POST', 'PollController@makeACopy', ['id' => 'uniikki']);
		$this->assertRedirectedTo('/');
		$this->assertSessionHasErrors();
	}

	public function testMakeCopyAsUser() {
		$this->fakeLoginUser();
		$this->testMakeCopyNotLoggedIn();
	}

	public function testMakeCopu() {
		$this->fakeLoginAdmin();
		$this->mockPoll()->save();
		$this->mockTimeidea()->save();
		$this->action('POST', 'PollController@makeACopy', ['id' => 'uniikki']);
		$this->assertRedirectedToAction('PollController@edit', ['id' => Poll::all()->last()->id]);
	}

	public function testDestroy() {
		$poll_ctrl = new PollController;
		$this->assertNull($poll_ctrl->destroy(1));
	}
}