<?php

class TimeideaControllerTest extends TestCase {

	public function testIndex() {
		$a = new TimeideaController;
		$this->assertNull($a->index());
	}

	public function testCreate() {
		$a = new TimeideaController;
		$this->assertNull($a->create());
	}
	
	public function testShow() {
		$ti = $this->mockTimeidea(1,1);
		$ti->save();

		$a = new TimeideaController;
		$view = $a->show($ti->id)->getData();
		$this->assertTrue(str_contains($view['timeidea'], $ti->date));
	}
	
	public function testEdit() {
		$a = new TimeideaController;
		$this->assertNull($a->edit(1));
	}

	public function testUpdate() {
		$a = new TimeideaController;
		$this->assertNull($a->update(1));
	}
	
	public function testDestroy() {
		$a = new TimeideaController;
		$this->assertNull($a->destroy(1));
	}
	
	public function testStore() {
		$tic = new TimeideaController;
		Request::replace($input=['poll_id'=>'25','begins'=>'14:00','ends'=>'16:00','date'=>'2015-11-11']);
		$polli = $this->mockPoll(25);
		$polli->save();
		$u = $this->mockUser(25);
		$u->save();
		$polli->users()->attach($u);
		$tic->Store();
		$this->assertTrue(Timeidea::find(1)->date=='2015-11-11');	
		$this->assertTrue(Timeidea::find(1)->begins=='14:00');
		$vastaukset =  $polli->answers();
		foreach($vastaukset as $vastaus)
			$this->assertTrue($vastaus->sopivuus=='eisovi');
	}
	public function testToimiikoMakeTimeideaOfInput() {
		Request::replace($input=['poll_id'=>'25','begins'=>'14:00','ends'=>'16:00','date'=>'2015-11-11']);
		$tic = new TimeideaController;
		$this->assertTrue(25==$tic->makeTimeideaOfInput()->poll_id);
	}	

	public function testSetAnswer() {
		$tic = new TimeideaController;
		$poll = $this->mockPoll(20);
		$poll->save();
		$u = $this->mockUser(20);
		$u->save();
		$poll->users()->attach($u);
		$tic->setAnswers($poll,15);
		$vastaukset = $poll->answers();
		foreach($vastaukset as $vastaus) 
			$this->assertTrue($vastaus->sopivuus=='eisovi');	

	}

}
