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
		$this->mockUser()->save();
		$this->mockPoll()->save();
		$this->mockTimeidea(['id' => 44, 'poll_id' => 43, 'description' => 'Future Primitive'])->save();
		$this->mockTimeidea(['id' => 45, 'poll_id' => 43, 'description' => 'Corridors of Power'])->save();
		$this->mockAnswer(['id' => 33, 'participant_id' => 42, 'timeidea_id'=>44, 'sopivuus' => 'sopii'])->save();
		$this->mockAnswer(['id' => 34, 'participant_id' => 42, 'timeidea_id'=>45, 'sopivuus' => 'sopii'])->save();

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