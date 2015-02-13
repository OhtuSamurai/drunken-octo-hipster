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

	public function testUpdateSopivuus() {
		$this->mockUser(51)->save();
		$this->mockPoll(23)->save();
		$this->mockTimeidea(44,23)->save();
		$this->mockTimeidea(45,23)->save();
		$this->mockAnswer(33,51,44)->save();
		$this->mockAnswer(34,51,45)->save();

		$answer = Answer::find(33);
		$this->assertEquals('sopii', $answer->sopivuus);

		$answer = Answer::find(34);
		$this->assertEquals('sopii', $answer->sopivuus);

		Request::replace($input=[33=>'ei sovi', 34=>'ei sovi']);

		$a = new AnswerController;
		$a->updateSopivuus();

		$answer = Answer::find(33);
		$this->assertEquals('ei sovi', $answer->sopivuus);

		$answer = Answer::find(34);
		$this->assertEquals('ei sovi', $answer->sopivuus);
	}

	public function testDestroy() {
		$a = new AnswerController;
		$this->assertNull($a->destroy(1));
	}
}