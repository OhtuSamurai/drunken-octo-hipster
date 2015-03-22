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

	public function testUpdateSopivuusMissClick() {
		$this->action('POST', 'AnswerController@updateSopivuus', [], ['poll_id' => 1]);
		$this->assertRedirectedToAction('PollController@show', ['id' => 1]);
		$this->assertSessionHasErrors();
	}

	public function testUpdateSopivuus() {
		$this->mockUser()->save();
		$this->mockPoll()->save();
		$this->mockAnswer(['id' => 33, 'participant_id' => 42, 'timeidea_id'=>44, 'sopivuus' => 'sopii'])->save();
		$this->mockAnswer(['id' => 34, 'participant_id' => 42, 'timeidea_id'=>45, 'sopivuus' => 'sopii'])->save();
		$this->action('POST', 'AnswerController@updateSopivuus', [], [33 => 'ei sovi', 'poll_id' => 1]);
		$this->assertRedirectedToAction('PollController@show', ['id' => 1]);
		$answer = Answer::find(33);
		$this->assertEquals('ei sovi', $answer->sopivuus);
		$answer = Answer::find(34);
		$this->assertEquals('sopii', $answer->sopivuus);
	}

	public function testDestroy() {
		$ans_ctrl = new AnswerController;
		$this->assertNull($ans_ctrl->destroy(1));
	}
}