<?php

class CommitteeControllerTest extends TestCase {

	public function testIndex() {
		$response = $this->action('GET', 'CommitteeController@index');

		$view = $response->original;
		$a = new CommitteeController;
		$this->assertEquals($a->index(), $view );
	}

	public function testCreate() {
		$a = new CommitteeController;
		$this->assertNull($a->create());
	}


	public function testStore() {
		$a = new CommitteeController;
		$this->assertNull($a->store());
	}

	public function testShow() {
		$a = new CommitteeController;
		$this->assertNull($a->show(1));
	}

	public function testEdit() {
		$a = new CommitteeController;
		$this->assertNull($a->edit(1));
	}


	public function testUpdate() {
		$a = new CommitteeController;
		$this->assertNull($a->update(1));
	}

	public function testDestroy() {
		$a = new CommitteeController;
		$this->assertNull($a->destroy(1));
	}
}