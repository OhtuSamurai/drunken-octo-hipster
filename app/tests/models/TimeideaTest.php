<?php

class TimeideaTest extends TestCase {

	public function testStoringTimeidea() {
		$this->mockTimeidea()->save();
		$this->assertEquals('Stay awhile and listen' ,Timeidea::find(23)->description);
	}

	public function testTimeideaInApoll() {
		$this->mockPoll(['id' => 43, 'toimikunta' => 'committee', 'is_open' => 1])->save();
		$this->mockTimeidea(['id' => 23, 'poll_id' => 43, 'description' => 'Stay awhile and listen'])->save();
		$this->assertEquals(Poll::find(43)->toimikunta, Timeidea::find(23)->poll->toimikunta);
	}

	public function testTimeideaWithAnswers() {
		$this->mockTimeidea()->save();
		$idea = Timeidea::find(23);
		
		$this->mockAnswer(['id' => 1, 'participant_id' => 99, 'timeidea_id'=>$idea->id, 'sopivuus' => 'sopii'])->save();
		$this->mockAnswer(['id' => 2, 'participant_id' => 99, 'timeidea_id'=>$idea->id, 'sopivuus' => 'sopii'])->save();

		$this->assertEquals($idea->answers[0]->sopivuus, Answer::find(1)->sopivuus);
		$this->assertEquals(2, count($idea->answers));
	}
}