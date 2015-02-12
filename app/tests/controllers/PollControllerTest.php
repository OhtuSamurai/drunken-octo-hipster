<?php

class PollControllerTest extends TestCase {
	
	public function testIndex() {
		$response = $this->action('GET', 'PollController@index');

		$view = $response->original;
		$a = new PollController;
		$this->assertEquals($a->index(), $view );
	}

	public function testCreate() {
		$a = new PollController;
		$this->assertNull($a->create());
	}
	/* TODO!!!
	public function testStore() {
		$a = new PollController;
		$this->assertNull($a->store());
	}*/
	
	public function testShow() {
		$p = $this->mockPoll(42);
		$p->save();

		$ctrl = new PollController;
		$view = $ctrl->show($p->id)->getData();
		$this->assertTrue(str_contains($view['poll'], $p->toimikunta));
	}

	public function testEdit() {
		$a = new PollController;
		$this->assertNull($a->edit(1));
	}
	/* TODO!!!
	public function testUpdate() {
		$a = new PollController;
		$this->assertNull($a->update(1));
	}*/

	public function testDestroy() {
		$a = new PollController;
		$this->assertNull($a->destroy(1));
	}
}