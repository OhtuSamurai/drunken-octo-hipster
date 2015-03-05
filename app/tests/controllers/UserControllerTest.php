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
		$response = $this->action('GET', 'UserController@show', array('id' => 1));

		$view = $response->original;
		$usr_ctrl = new UserController;
		$this->assertEquals($usr_ctrl->show(1), $view );
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