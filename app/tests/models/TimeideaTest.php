<?php

class TimeideaTest extends TestCase {

	public function testStoringTimeidea() {
		$idea = $this->mockTimeidea(27,27);
		$idea->save();
		$this->assertEquals(Timeidea::find(27)->date, $idea->date);
	}

	public function testTimeideaInApoll() {
		$p = $this->mockPoll(42);
		$p->save();

		$idea = $this->mockTimeidea(42, $p->id);
		$idea->save();

		$this->assertEquals($idea->poll->toimikunta, $p->toimikunta);
	}

	public function testTimeideaWithAnswers() {
		$idea = $this->mockTimeidea(42, 12);
		$idea->save();
		
		$a = $this->mockAnswer(36, 1, $idea->id);
		$a->save();

		$this->assertEquals($idea->answers[0]->sopivuus, $a->sopivuus);
	}
}