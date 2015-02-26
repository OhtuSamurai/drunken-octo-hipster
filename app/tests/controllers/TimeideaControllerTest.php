<?php

class TimeideaControllerTest extends TestCase {

	public function testIndex() {
		$idea_ctrl = new TimeideaController;
		$this->assertNull($idea_ctrl->index());
	}

	public function testCreate() {
		$idea_ctrl = new TimeideaController;
		$this->assertNull($idea_ctrl->create());
	}
	
	public function testShow() {
		$this->mockTimeidea()->save();

		$idea_ctrl = new TimeideaController;
		$actual = Timeidea::all()->first();
		$view = $idea_ctrl->show($actual->id)->getData();
		$this->assertTrue(str_contains($view['timeidea'], $actual->description));
	}
	
	public function testEdit() {
		$idea_ctrl = new TimeideaController;
		$this->assertNull($idea_ctrl->edit(1));
	}

	public function testUpdate() {
		$idea_ctrl = new TimeideaController;
		$this->assertNull($idea_ctrl->update(1));
	}
	
	public function testDestroy() {
		$idea_ctrl = new TimeideaController;
		$this->assertNull($idea_ctrl->destroy(1));
	}
	
	public function testStore() {
		$tic = new TimeideaController;
		Request::replace($input=['poll_id'=>'43','description'=>'kokista']);
		$polli = $this->mockPoll();
		$polli->save();
		$usr = $this->mockUser();
		$usr->save();
		$polli->users()->attach($usr);
		$tic->store();
		$this->assertTrue(Timeidea::find(1)->description=='kokista');	
		$vastaukset =  $polli->answers();
		foreach($vastaukset as $vastaus)
			$this->assertTrue($vastaus->sopivuus=='eisovi');
	}

	public function testUnvalidStoring() {
		$this->action('POST', 'TimeideaController@store');
		$this->assertRedirectedToAction('PollController@show', array('id' => ''));
	}
}
