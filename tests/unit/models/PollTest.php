<?php

class PollTest extends TestCase {
		
	public function testUudenPollinLuominen() {
		$this->mockPoll()->save();
		$this->assertEquals(Poll::find('uniikki')->toimikunta, "committee");
	}

	public function testTimeideanHakuFunktioToimii() {
		$this->mockPoll()->save();	
		$this->mockTimeidea(['id' => 23, 'poll_id' => 'uniikki', 'description' => 'Stay awhile and listen'])->save();
		$this->assertEquals(Poll::find('uniikki')->timeideas()->first()->description, Timeidea::find(23)->description);
	}

	public function testPollWithUser() {
		$this->mockPoll()->save();
		$this->mockUser()->save();
		
		$poll = Poll::find('uniikki');
		$usr = User::find(42);
		$poll->users()->attach($usr);

		$this->assertEquals($poll->users->first()->username, $usr->username);
	}

	public function testPollWithAnswers() {
		$this->mockPoll()->save();
		$this->mockTimeidea(['id' => 23, 'poll_id' => 'uniikki', 'description' => 'Stay awhile and listen'])->save();
		$idea = Timeidea::find(23);
		
		for($i = 1; $i<4; $i++)
			$this->mockAnswer(['id' => $i, 'participant_id' => $i, 'timeidea_id'=>$idea->id, 'sopivuus' => 'sopii'])->save();
		foreach(Poll::find('uniikki')->answers as $ans)
			$this->assertEquals(Answer::find($ans->id)->sopivuus, $ans->sopivuus);
	}

	public function testPollLurkers() {
		$this->mockPoll()->save();
		$this->mockLurker()->save();
		$this->assertEquals(Lurker::find(314)->name, Poll::find('uniikki')->lurkers()->first()->name);
	}
}
