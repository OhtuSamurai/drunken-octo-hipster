<?php

class AttachmentControllerTest extends TestCase {
	
	public function testStoreAsNotLoggedIn() {
		$this->action('post', 'AttachmentController@store');
		$this->assertRedirectedTo('/');
	}

	public function testStoreAsRegularUser() {
		$this->fakeLoginUser();
		$this->testStoreAsNotLoggedIn();
	}

	public function testStoreWithMissingFile() {
		$this->fakeLoginAdmin();
		$this->mockCommittee()->save();
		$this->action('post', 'AttachmentController@store', [], ['committee_id' => 1]);
		$this->assertRedirectedToAction('CommitteeController@show', ['id' => 1]);
		$this->assertSessionHasErrors();
	}

	public function testStore() {
		$this->fakeLoginAdmin();
		$this->mockCommittee()->save();
		$this->action('post', 'AttachmentController@store', [], ['committee_id' => 1, 'tiedosto' => $this->mockAttachment()]);
		$this->assertRedirectedToAction('CommitteeController@show', ['id' => 1]);
	}

	public function testDownloadAsNotLoggedIn() {
		$this->mockCommittee()->save();
		$this->mockAttachment()->save();
		$this->action('get', 'AttachmentController@download', ['committee_id' => 1, 'id' => 255]);
		$this->assertRedirectedTo('/');
		$this->assertSessionHasErrors();
	}

	public function testDownloadAsUserNotInCommittee() {
		$this->mockCommittee()->save();
		$this->mockAttachment()->save();
		$this->mockUserWithId(72)->save();
		$com = Committee::find(1);
		$usr = User::find(72);
		$com->users()->attach($usr);
		$this->fakeLoginUser();
		$this->action('get', 'AttachmentController@download', ['committee_id' => 1, 'id' => 255]);
		$this->assertRedirectedTo('/');
		$this->assertSessionHasErrors();
	}

	public function testDownload() {
		$this->fakeLoginUser();
		$this->mockCommittee()->save();
		$this->mockAttachment()->save();
		$com = Committee::find(1);
		$usr = User::find(42);
		$com->users()->attach($usr);
		$this->action('get', 'AttachmentController@download', ['committee_id' => 1, 'id' => 255]);
		$this->assertResponseOk();
	}

	public function testDownloadTwice() {
		$this->fakeLoginUser();
		$this->mockCommittee()->save();
		$this->mockAttachment()->save();
		$com = Committee::find(1);
		$usr = User::find(42);
		$com->users()->attach($usr);
		$this->action('get', 'AttachmentController@download', ['committee_id' => 1, 'id' => 255]);
		$this->assertResponseOk();
		//for addUserInAttachmentsUserTable if-block
		$this->action('get', 'AttachmentController@download', ['committee_id' => 1, 'id' => 255]);
		$this->assertResponseOk();
	}

	public function testDestroy() {
		$this->fakeLoginAdmin();			
		$this->mockCommittee()->save();
		$this->mockDestroyableAttachment()->save();
		$this->assertNotNull(Attachment::find(255));
		$this->action('delete','AttachmentController@destroy',['committee_id'=>1, 'id'=>255]);
		$this->assertRedirectedToAction('CommitteeController@show', ['id' => 1]);
		$this->assertNull(Attachment::find(255));
	}

	public function testDestroyAsNotLoggedIn() {
		$this->mockDestroyableAttachment()->save();
		$this->assertNotNull(Attachment::find(255));
		$this->action('delete','AttachmentController@destroy',['id'=>255,'committee_id'=>1]);
		$this->assertRedirectedTo('/');
		$this->assertSessionHasErrors();
		$this->assertNotNull(Attachment::find(255));
	}

	public function testDestroyWithRegularUser() {
		$this->fakeLoginUser();
		$this->testDestroyAsNotLoggedIn();
	}
}
