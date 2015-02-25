<?php

class AnswerControllerTest extends TestCase {

	public function testIndex() {
		$ans_ctrl = new AnswerController;
		$this->assertNull($ans_ctrl->index());
	}

	public function testCreate() {
		$ans_ctrl = new AnswerController;
		$this->assertNull($ans_ctrl->create());
	}

	public function testStore() {
		$ans_ctrl = new AnswerController;
		$this->assertNull($ans_ctrl->store());
	}

	public function testShow() {
		$ans_ctrl = new AnswerController;
		$this->assertNull($ans_ctrl->show(1));
	}

	public function testEdit() {
		$ans_ctrl = new AnswerController;
		$this->assertNull($ans_ctrl->edit(1));
	}


	public function testUpdate() {
		$ans_ctrl = new AnswerController;
		$this->assertNull($ans_ctrl->update(1));
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
	
		$ans_ctrl = new AnswerController;
		$ans_ctrl->updateSopivuus();

		$answer = Answer::find(33);
		$this->assertEquals('ei sovi', $answer->sopivuus);

		$answer = Answer::find(34);
		$this->assertEquals('ei sovi', $answer->sopivuus);
	}

	public function testDestroy() {
		$ans_ctrl = new AnswerController;
		$this->assertNull($ans_ctrl->destroy(1));
	}
}