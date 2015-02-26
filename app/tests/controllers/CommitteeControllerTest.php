<?php

class CommitteeControllerTest extends TestCase {

	public function testIndex() {
		$response = $this->action('GET', 'CommitteeController@index');
		$view = $response->original;
		$com_ctrl = new CommitteeController;
		$this->assertEquals($com_ctrl->index(), $view );
	}

	public function testCreate() {
		$com_ctrl = new CommitteeController;
		$this->assertNull($com_ctrl->create());
	}


	public function testStore() {
		$com_ctrl = new CommitteeController;
		$this->assertNull($com_ctrl->store());
	}

	public function testShow() {
		$com_ctrl = new CommitteeController;
		$this->assertNull($com_ctrl->show(1));
	}

	public function testEdit() {
		$com_ctrl = new CommitteeController;
		$this->assertNull($com_ctrl->edit(1));
	}


	public function testUpdate() {
		$com_ctrl = new CommitteeController;
		$this->assertNull($com_ctrl->update(1));
	}

	public function testDestroy() {
		$com_ctrl = new CommitteeController;
		$this->assertNull($com_ctrl->destroy(1));
	}
}