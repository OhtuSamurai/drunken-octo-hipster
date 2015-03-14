<?php

class UserControllerTest extends TestCase {

	public function testIndex() {
		$response = $this->action('GET', 'UserController@index');

		$view = $response->original;
		$usr_ctrl = new UserController;
		$this->assertEquals($usr_ctrl->index(), $view );
	}

	public function testCreate() {
		$usr_ctrl = new UserController;
		$this->assertNull($usr_ctrl->create());
	}


	public function testStore() {
		$usr_ctrl = new UserController;
		$this->assertNull($usr_ctrl->store());
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
	}

	public function testShowWithAdmin() {
		$this->fakeLoginAdmin();
		$response = $this->action('GET', 'UserController@show', array('id' => 123));

		$view = $response->original;
		$usr_ctrl = new UserController;
		$this->assertEquals($usr_ctrl->show(123), $view );		
	}

	public function testEdit() {
		$usr_ctrl = new UserController;
		$this->assertNull($usr_ctrl->edit(1));
	}


	public function testUpdate() {
		$usr_ctrl = new UserController;
		$this->assertNull($usr_ctrl->update(1));
	}

	public function testDestroy() {
		$usr_ctrl = new UserController;
		$this->assertNull($usr_ctrl->destroy(1));
	}
}