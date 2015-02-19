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
		$this->assertTrue(str_contains($view['timeidea'], $ti->description));
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
		Request::replace($input=['poll_id'=>'25','description'=>'kokista']);
		$polli = $this->mockPoll(25);
		$polli->save();
		$u = $this->mockUser();
		$u->save();
		$polli->users()->attach($u);
		$tic->Store();
		$this->assertTrue(Timeidea::find(1)->description=='kokista');	
		$vastaukset =  $polli->answers();
		foreach($vastaukset as $vastaus)
			$this->assertTrue($vastaus->sopivuus=='eisovi');
	}
}
