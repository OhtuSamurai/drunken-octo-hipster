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
	/* TODO!!!
	public function testStore() {
		$a = new TimeideaController;
		$this->assertNull($a->store());
	}*/
	
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
}