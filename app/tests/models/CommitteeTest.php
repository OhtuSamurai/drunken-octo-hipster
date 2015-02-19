<?php

class CommitteeTest extends TestCase {

	public function testStoringCommittee() {
		$this->mockCommittee()->save();
		$this->assertEquals(Committee::find(1)->name, 'committee');
	}

	public function testCommitteeHasUsers() {
		$com = $this->mockCommittee(['id' => 1, 'name' => 'committee', 'time' => 'default']);
		$com->save();

		$u = $this->mockUser();
		$u->save();

		$u11 = $this->mockUser();
		$u11->id = 11;
		$u11->save();

		$com->users()->attach($u);
		$com->users()->attach($u);
		
		$this->assertEquals($com->users[0]->username, $u->username);
		$this->assertEquals(2, count($com->users));
	}
}