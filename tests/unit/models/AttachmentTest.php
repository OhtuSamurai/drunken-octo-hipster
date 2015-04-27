<?php

class AttachmentTest extends TestCase {
		
	public function testCommitteeFunction() 
	{
		$this->mockCommittee()->save();
		$this->mockAttachment()->save();
		$this->assertEquals(Committee::find(1)->name,Attachment::find(255)->committee->name);
	}

	public function testUsersFunction() 
	{
		$this->mockAttachment()->save();
		$this->mockUser()->save();
		
		$attachment = Attachment::find(255);
		$usr = User::find(42);

		$attachment->users()->attach($usr);
		$this->assertEquals($usr->username, $attachment->users()->first()->username); 
	}

	public function testGetUserIDsFunction() 
	{
		$this->mockAttachment()->save();
		$this->mockUser()->save();
		
		$attachment = Attachment::find(255);
		$usr = User::find(42);

		$attachment->users()->attach($usr);
		$this->assertEquals(42, head($attachment->getUserIDs()));
	}

	public function testGetSize()
	{
		$this->mockAttachment()->save();
		$this->assertEquals(4, Attachment::find(255)->getSize());
	}
}