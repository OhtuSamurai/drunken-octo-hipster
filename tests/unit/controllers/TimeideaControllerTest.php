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
	
	public function testShow() { //Pakko tehdä suoraan kontrolleria käyttämällä, koska route undefined
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
		$this->fakeLoginAdmin();
		$poll = $this->mockPoll();
		$poll->save();
		$usr = $this->mockUser();
		$usr->save();
		$poll->users()->attach($usr);
		$this->mockLurker()->save();
		$this->action('POST', 'TimeideaController@store', null, ['poll_id'=>'43','description'=>'kokista']);
		$this->assertRedirectedToAction('PollController@show', ['id' => $poll->id]);
		$this->assertEquals('kokista', Timeidea::find(1)->description);
		foreach($poll->answers() as $answer)
			$this->assertEquals('eisovi', $answer->sopivuus);
}

	public function testStoreWithoutAdmin() {
		$poll = $this->mockPoll();
		$poll->save();
		$this->action('POST', 'TimeideaController@store', null, ['poll_id' => $poll->id]);
		$this->assertRedirectedToAction('PollController@show', array('id' => $poll->id));
		$this->assertSessionHasErrors();
	}

	public function testStoreWithRegularUser() {
		$this->fakeLoginUser();
		$this->testStoreWithoutAdmin();
	}

	public function testStoreWithWrongCreds() {
		$this->fakeLoginAdmin();
		$poll = $this->mockPoll();
		$poll->save();
		$this->action('POST', 'TimeideaController@store', null, ['poll_id' => $poll->id]);
		$this->assertRedirectedToAction('PollController@show', ['id' => $poll->id]);
		$this->assertSessionHasErrors('description');
	} 
}
