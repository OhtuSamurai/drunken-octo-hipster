<?php

class UserTest extends TestCase {

	public function testStoringUser() {
		$this->mockUser()->save();
		$this->assertEquals(User::find(42)->username, "usr");
	}

	public function testUserParticipatesInAPoll() {
		$poll = $this->mockPoll(42);
		$poll->save();

		$usr = $this->mockUser();
		$usr->save(); 
		$usr->polls()->attach($poll);
		$this->assertEquals($usr->polls[0]->toimikunta, $poll->toimikunta);
	}
}