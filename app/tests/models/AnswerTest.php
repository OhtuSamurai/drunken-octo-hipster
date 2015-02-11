<?php

class AnswerTest extends TestCase {
		
	public function testAnswerWithATimeidea() {
		$t = $this->mockTimeidea(2,2);
		$t->save();
		$a = $this->mockAnswer(1,1,$t->id);
		$a->save();

		$this->assertEquals($a->timeidea->date, $t->date);
	}
}