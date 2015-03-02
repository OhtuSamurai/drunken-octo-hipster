<?php

class CommitteeControllerTest extends TestCase {

	public function testIndex() {
		$response = $this->action('GET', 'CommitteeController@index');
		$view = $response->original;
		$com_ctrl = new CommitteeController;
		$this->assertEquals($com_ctrl->index(), $view );
	}

	public function testCreate() {
		$com_ctrl = new CommitteeController;
		$this->assertNull($com_ctrl->create());
	}

	public function testStore() {
		$poll = $this->mockPoll();
		$poll->save();
		$user = $this->mockUser();
		$user->save();
		$poll->users()->attach($user);
		$poll->save();

		$ctrl = new CommitteeController;
		Request::replace($input=['poll_id'=>43, 'time'=>'time', 'user' => ['42']]);
		$ctrl->store();

		$committee = Committee::find(1);
		$this->assertEquals('committee', $committee->name);
		$this->assertTrue($committee->users()->get()->contains(42));
	}

	public function testShow() {
		$this->mockCommittee()->save();
		
		$committee = Committee::find(1);
		$ctrl = new CommitteeController;
		
		$view = $ctrl->show($committee->id)->getData();
		$this->assertTrue(str_contains($view['committee'], $committee->name));
	}

	public function testEdit() {
		$com_ctrl = new CommitteeController;
		$this->assertNull($com_ctrl->edit(1));
	}


	public function testUpdate() {
		$com_ctrl = new CommitteeController;
		$this->assertNull($com_ctrl->update(1));
	}

	public function testDestroy() {
		$com_ctrl = new CommitteeController;
		$this->assertNull($com_ctrl->destroy(1));
	}
}