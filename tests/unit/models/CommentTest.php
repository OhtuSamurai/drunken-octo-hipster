<?php
class CommentTest extends TestCase {
	public function testUserFunction() {
		$this->mockUserWithId(245)->save();
		$this->mockComment()->save();
		$comment = Comment::find(12);
		$comment->user_id=245;
		$this->assertTrue($comment->user->first_name=='f');
	}

	public function testPollFunction() {
		$this->mockPoll()->save();
		$this->mockComment()->save();
		$this->assertEquals(Comment::find(12)->poll->toimikunta, Poll::find('uniikki')->toimikunta);
	}
}	
