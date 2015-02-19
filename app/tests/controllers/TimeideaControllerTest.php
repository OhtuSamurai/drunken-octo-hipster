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
		$this->mockTimeidea()->save();

		$a = new TimeideaController;
		$actual = Timeidea::all()->first();
		$view = $a->show($actual->id)->getData();
		$this->assertTrue(str_contains($view['timeidea'], $actual->description));
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
		Request::replace($input=['poll_id'=>'43','description'=>'kokista']);
		$polli = $this->mockPoll();
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
