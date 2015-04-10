<?php

class CommitteeTest extends TestCase {

	public function testStoringCommittee() {
		$this->mockCommittee()->save();
		$this->assertEquals(Committee::find(1)->name, 'committee');
	}

	public function testCommitteeHasUsers() {
		$this->mockCommittee(['id' => 1, 'name' => 'committee', 'time' => 'default'])->save();
		$this->mockUser()->save();
		
		$u11 = $this->mockUser();
		$u11->id = 11;
		$u11->save();

		$com = Committee::find(1);

		$com->users()->attach(User::find(42));
		$com->users()->attach($u11);
		
		$this->assertEquals($com->users->last()->username, $u11->username);
		$this->assertEquals(2, count($com->users));
	}

	public function testCommitteeAttachement() {
		$this->mockCommittee()->save();
		$this->mockAttachment()->save();
		$this->assertEquals(Attachment::find(255)->filename,Committee::find(1)->attachments()->first()->filename);
	}
}