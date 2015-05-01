<?php

class AnswerControllerTest extends TestCase {

	public function testUpdateSopivuusMissClick() {
		$this->action('PUT', 'AnswerController@updateSopivuus', [], ['poll_id' => 1]);
		$this->assertRedirectedToAction('PollController@show', ['id' => 1]);
		$this->assertSessionHasErrors();
	}

	public function testUpdateSopivuus() {
		$this->mockUser()->save();
		$this->mockPoll()->save();
		$this->mockAnswer(['id' => 33, 'participant_id' => 42, 'timeidea_id'=>44, 'sopivuus' => 'sopii'])->save();
		$this->mockAnswer(['id' => 34, 'participant_id' => 42, 'timeidea_id'=>45, 'sopivuus' => 'sopii'])->save();
		$this->action('PUT', 'AnswerController@updateSopivuus', [], [33 => 'ei sovi', 'poll_id' => 1]);
		$this->assertRedirectedToAction('PollController@show', ['id' => 1]);
		$answer = Answer::find(33);
		$this->assertEquals('ei sovi', $answer->sopivuus);
		$answer = Answer::find(34);
		$this->assertEquals('sopii', $answer->sopivuus);
	}
}