<?php

class AnswerTest extends TestCase {
		
	public function testAnswerWithATimeidea() {
		$this->mockTimeidea()->save();
		$idea = Timeidea::find(23);

		$this->mockAnswer(['id' => 2, 'participant_id' => 99, 'timeidea_id'=>$idea->id, 'sopivuus' => 'sopii'])->save();

		$this->assertEquals(Answer::find(2)->timeidea->description, $idea->description);
	}
}