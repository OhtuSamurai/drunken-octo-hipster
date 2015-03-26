<?php

class LurkerTest extends TestCase {
		
	public function testLurkersPoll() {
		$this->mockPoll()->save();
		$this->mockLurker()->save();
		$this->assertEquals(Lurker::find(314)->poll->toimikunta, Poll::find(43)->toimikunta);
	}
}