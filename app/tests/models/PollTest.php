<?php

class PollTest extends TestCase {
		
	public function testUudenPollinLuominen() {
		$poll = $this->mockPoll(27);
		$poll->save();
		$this->assertEquals(Poll::find(27)->toimikunta, $poll->toimikunta);
	}

	public function testTimeideanHakuFunktioToimii() {
		$poll=$this->mockPoll(35);
		$poll->save();
		
		$idea = $this->mockTimeidea(35, $poll->id);
		$idea->save();
	
		$haetut = $poll->timeIdeas;
		$this->assertEquals($haetut[0]->date,$idea->date);
	}

	public function testPollWithUser() {
		$poll = $this->mockPoll(42);
		$poll->save();

		$u = $this->mockUser();
		$u->save();
		$poll->users()->attach($u);
		$this->assertEquals($poll->users[0]->username, $u->username);
	}

	public function testPollWithAnswers() {
		$poll=$this->mockPoll(35);
		$poll->save();
		
		$idea = $this->mockTimeidea(35, $poll->id);
		$idea->save();
		
		$a = $this->mockAnswer(42, 1337, $poll->id);
		$a->save();

		$pa = $poll->answers;
		foreach($pa as $p)
			$this->assertEquals($p->sopivuus, $a->sopivuus);
	}
}
