<?php 
	class CommentControllerTest extends TestCase {
		
		public function testStore() {
			$this->fakeLoginUser();
			$this->mockPoll()->save();
			$this->action('POST','CommentController@store', [], ['poll_id' => 'uniikki', 'commenttext' => 'no-copi-pastarino']);
			$this->assertRedirectedToAction('PollController@show', ['id' => 'uniikki']);
			$this->assertEquals(1, count(Poll::find('uniikki')->comments));
		}

		public function testStoreAsNotLoggedIn() {
			$this->mockPoll()->save();
			$this->action('POST','CommentController@store', [], ['poll_id' => 'uniikki', 'commenttext' => 'no-copi-pastarino']);
			$this->assertRedirectedToAction('PollController@show', ['id' => 'uniikki']);
			$this->assertEquals(1, count(Poll::find('uniikki')->comments));
			$this->assertEquals("Anonyymi", Comment::find(1)->author_name);
		}

		public function testStoreAsNotLoggedInWithGivenAuthorName() {
			$this->mockPoll()->save();
			$this->action('POST','CommentController@store', [], ['poll_id' => 'uniikki', 'author_name' => 'pedro','commenttext' => 'no-copi-pastarino']);
			$this->assertRedirectedToAction('PollController@show', ['id' => 'uniikki']);
			$this->assertEquals(1, count(Poll::find('uniikki')->comments));
			$this->assertEquals("pedro", Comment::find(1)->author_name);
		}
	}
