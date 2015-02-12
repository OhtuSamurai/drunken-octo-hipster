<?php

class AnswerControllerTest extends TestCase {

	public function testIndex() {
		$a = new AnswerController;
		$this->assertNull($a->index());
	}

	public function testCreate() {
		$a = new AnswerController;
		$this->assertNull($a->create());
	}

	public function testStore() {
		$a = new AnswerController;
		$this->assertNull($a->store());
	}

	public function testShow() {
		$a = new AnswerController;
		$this->assertNull($a->show(1));
	}

	public function testEdit() {
		$a = new AnswerController;
		$this->assertNull($a->edit(1));
	}


	public function testUpdate() {
		$a = new AnswerController;
		$this->assertNull($a->update(1));
	}

	public function testDestroy() {
		$a = new AnswerController;
		$this->assertNull($a->destroy(1));
	}
}