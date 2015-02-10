<?php

class PollTest extends TestCase {
	private function teeUusiPolli($id) {
		$poll = new Poll;
		$poll->toimikunta = "testi";
		$poll->is_open=1;
		$poll->id=$id;		
		return $poll;
	}
	public function testUudenPollinLuominen() {
		$poll = $this->teeUusiPolli(27);
		$poll->save();
		$this->assertEquals(Poll::find(27)->toimikunta,"testi");
	}

	public function testTimeideanHakuFunktioToimii() {
		$poll=$this->teeUusiPolli(35);
		$poll->save();
		
		$idea = new Timeidea;
		$idea->poll_id=35;
		$idea->date="2015-01-01";
		$idea->begins="10:00:00.000";
		$idea->ends="11:00:00.000";
		$idea->save();
	
		$haetut = $poll->timeIdeas;
		$this->assertEquals($haetut[0]->date,$idea->date);
	}
}
