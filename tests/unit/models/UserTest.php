<?php

class UserTest extends TestCase {

	public function testStoringUser() {
		$this->mockUser()->save();
		$this->assertEquals(User::find(42)->username, "usr");
	}

	public function testUserParticipatesInAPoll() {
		$this->mockPoll()->save();
		$poll = Poll::find(43);

		$usr = $this->mockUser();
		$usr->save(); 
		$usr->polls()->attach($poll);

		$this->assertEquals($usr->polls[0]->toimikunta, $poll->toimikunta);
	}

	public function testUserInACommittee() {
		$com = $this->mockCommittee();
		$com->save();

		$usr = $this->mockUser();
		$usr->save();

		$usr->committees()->attach($com);
		$this->assertEquals($com->name, $usr->committees[0]->name);
	}
}