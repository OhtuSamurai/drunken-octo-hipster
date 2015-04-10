<?php 
class CommentControllerTest extends TestCase {
		
	public function testStoreWithPollid() {
		$this->fakeLoginUser();
		$this->mockPoll()->save();
		$this->action('POST','CommentController@store', [], ['poll_id' => 'uniikki', 'commenttext' => 'no-copi-pastarino']);
		$this->assertRedirectedToAction('PollController@show', ['id' => 'uniikki']);
		$this->assertEquals(1, count(Poll::find('uniikki')->comments));
	}

	public function testStoreWithPollidAsNotLoggedIn() {
		$this->mockPoll()->save();
		$this->action('POST','CommentController@store', [], ['poll_id' => 'uniikki', 'commenttext' => 'no-copi-pastarino']);
		$this->assertRedirectedToAction('PollController@show', ['id' => 'uniikki']);
		$this->assertEquals(1, count(Poll::find('uniikki')->comments));
		$this->assertEquals("Anonyymi", Comment::find(1)->author_name);
	}

	public function testStoreWithPollidAsNotLoggedInWithGivenAuthorName() {
		$this->mockPoll()->save();
		$this->action('POST','CommentController@store', [], ['poll_id' => 'uniikki', 'author_name' => 'pedro','commenttext' => 'no-copi-pastarino']);
		$this->assertRedirectedToAction('PollController@show', ['id' => 'uniikki']);
		$this->assertEquals(1, count(Poll::find('uniikki')->comments));
		$this->assertEquals("pedro", Comment::find(1)->author_name);
	}

	public function testStoreWithCommitteeidAsNotLoggedIn() {
		$this->mockCommittee()->save();
		$this->action('POST','CommentController@store', [], ['committee_id' => 1,'commenttext' => 'no-copi-pastarino']);
		$this->assertRedirectedToAction('CommitteeController@show', ['id' => 1]);
		$this->assertSessionHasErrors();
	}

	public function testStoreWithCommitteeidWithNonMember() {
		$this->fakeLoginUser();
		$this->mockCommittee()->save();
		$this->mockUserWithId(72)->save();
		$com = Committee::find(1);
		$usr = User::find(72);
		$com->users()->attach($usr);
		$this->action('POST','CommentController@store', [], ['committee_id' => 1,'commenttext' => 'no-copi-pastarino']);
		$this->assertRedirectedToAction('CommitteeController@show', ['id' => 1]);
		$this->assertSessionHasErrors();
	}

	public function testStoreWithCommitteeidAndAdmin() {
		$this->fakeLoginAdmin();
		$this->mockCommittee()->save();
		$this->action('POST','CommentController@store', [], ['committee_id' => 1,'commenttext' => 'no-copi-pastarino']);
		$this->assertRedirectedToAction('CommitteeController@show', ['id' => 1]);
	}

	public function testStoreWithCommitteeidAndAdminMissingCommenttext() {
		$this->fakeLoginAdmin();
		$this->mockCommittee()->save();
		$this->action('POST','CommentController@store', [], ['committee_id' => 1]);
		$this->assertRedirectedToAction('CommitteeController@show', ['id' => 1]);
		$this->assertSessionHasErrors('commenttext');
	}

	public function testStoreWithCommitteeidAndMember() {
		$this->fakeLoginUser();
		$this->mockCommittee()->save();
		$com = Committee::find(1);
		$usr = User::find(42);
		$com->users()->attach($usr);
		$this->action('POST','CommentController@store', [], ['committee_id' => 1,'commenttext' => 'no-copi-pastarino']);
		$this->assertRedirectedToAction('CommitteeController@show', ['id' => 1]);	
	}

	public function testStoreWithMissingResourceId() {
		$this->action('POST', 'CommentController@store');
		$this->assertRedirectedTo('/');
		$this->assertSessionHasErrors();
	}
}
