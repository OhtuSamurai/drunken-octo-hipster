<?php

class UserTest extends TestCase {

	public function testStoringUser() {
		$this->mockUser()->save();
		$this->assertEquals(User::find(42)->username, "usr");
	}

	// tests also function n_poll
	public function testUserInPoll() {
		$this->mockPoll()->save();
		$poll = Poll::find('uniikki');
		$usr = $this->mockUser();
		$usr->save(); 
		$usr->polls()->attach($poll);
		$this->assertEquals($usr->polls[0]->toimikunta, $poll->toimikunta);
		$this->assertEquals(1, $usr->n_poll());
	}

	// tests also function n_committee
	public function testUserInCommittee() {
		$com = $this->mockCommittee();
		$com->save();
		$usr = $this->mockUser();
		$usr->save();
		$usr->committees()->attach($com);
		$this->assertEquals($com->name, $usr->committees[0]->name);
		$this->assertEquals(1, $usr->n_committee());
	}

	public function testN_comment() {
		$usr = $this->mockUser()->save();
		$comment = $this->mockComment()->save();
		$this->assertEquals(1, User::find(42)->n_comment());
	}

	public function testCurr_polls() {
		$poll = $this->mockPoll();
		$poll->save();
		$poll2 = $this->mockPoll(['id' => '314!', 'toimikunta' => 'committee', 'is_open' => 0]);
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