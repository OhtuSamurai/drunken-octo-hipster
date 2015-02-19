<?php

class AnswerTest extends TestCase {
		
	public function testAnswerWithATimeidea() {
		$this->mockTimeidea()->save();
		$t = Timeidea::find(23);

		$this->mockAnswer(['id' => 2, 'participant_id' => 99, 'timeidea_id'=>$t->id, 'sopivuus' => 'sopii'])->save();

		$this->assertEquals(Answer::find(2)->timeidea->description, $t->description);
	}
}