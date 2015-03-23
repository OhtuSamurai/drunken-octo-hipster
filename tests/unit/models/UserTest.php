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

	public function testCurr_polls() {
		$poll = $this->mockPoll();
		$poll->save();

		$poll2 = $this->mockPoll(['id' => 44, 'toimikunta' => 'committee', 'is_open' => 0]);
		$poll2->save();

		$usr = $this->mockUser();
		$usr->save();

		$usr->polls()->attach($poll);
		$usr->polls()->attach($poll2);
		$this->assertEquals(1, count($usr->curr_polls()));		
	}

	public function testCurr_committees() {
		$com = $this->mockCommittee();
		$com->save();

		$com2 = $this->mockCommittee(['id' => 2, 'name' => 'committee', 'time' => 'default', 'is_open' => 0]);
		$com2->save();

		$usr = $this->mockUser();
		$usr->save();

		$usr->committees()->attach($com);
		$usr->committees()->attach($com2);
		$this->assertEquals(1, count($usr->curr_committees()));		
	}
}