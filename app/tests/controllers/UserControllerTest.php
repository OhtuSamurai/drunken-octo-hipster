<?php

class UserControllerTest extends TestCase {

	public function testIndex() {
		$response = $this->action('GET', 'UserController@index');

		$view = $response->original;
		$a = new UserController;
		$this->assertEquals($a->index(), $view );
	}

	public function testCreate() {
		$a = new UserController;
		$this->assertNull($a->create());
	}


	public function testStore() {
		$a = new UserController;
		$this->assertNull($a->store());
	}

	public function testShow() {
		$a = new UserController;
		$this->assertNull($a->show(1));
	}

	public function testEdit() {
		$a = new UserController;
		$this->assertNull($a->edit(1));
	}


	public function testUpdate() {
		$a = new UserController;
		$this->assertNull($a->update(1));
	}

	public function testDestroy() {
		$a = new UserController;
		$this->assertNull($a->destroy(1));
	}
}