<?php

class UserTest extends TestCase {
	
	public function testStoringUser() {
		$usr = $this->mockUser(42);
		$usr->save();
		$this->assertEquals(User::find(42)->username,"username");
	}

	public function testUserParticipatesInAPoll() {
		$poll = $this->mockPoll(42);
		$poll->save();

		$u = $this->mockUser(42);
		$u->save();

		$u->polls()->attach($poll);
		$u_participates = $u->polls;

		$this->assertEquals($u_participates[0]->toimikunta, $poll->toimikunta);
	}
}