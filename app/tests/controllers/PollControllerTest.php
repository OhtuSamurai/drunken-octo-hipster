<?php

class PollControllerTest extends TestCase {
	
	public function testIndex() {
		$response = $this->action('GET', 'PollController@index');

		$view = $response->original;
		$poll_ctrl = new PollController;
		$this->assertEquals($poll_ctrl->index(), $view );
	}

	public function testCreate() {
		$poll_ctrl = new PollController;
		$this->assertNull($poll_ctrl->create());
	}

	public function testStore() {
		$this->fakeLogin();

		$poll_ctrl = new PollController;
		$params = ['id' => 42, 'first_name' => 'f', 'last_name' => 'l', 'department' => 'deb', 'position' => 'pos', 'username' => 'usr'];

		//luodaan userit ideillä 51,52,53
		for($i = 51; $i<54; $i++) {
			$params['id'] = $i;
			$this->mockUser($params)->save();
		}

		Request::replace($input=['toimikunta'=>'Hieno Toimikunta', 'user'=>[51, 52]]);
		$poll_ctrl->store();
		$poll = Poll::find(1);

		$this->assertEquals(1, $poll->is_open);
		$this->assertTrue($poll->toimikunta=='Hieno Toimikunta');
		$this->assertTrue($poll->users()->get()->contains(51));
		$this->assertTrue($poll->users()->get()->contains(52));
		$this->assertFalse($poll->users()->get()->contains(53));
	}
	
	public function testShow() {
		$this->mockPoll()->save();
		
		$poll = Poll::find(43);
		$ctrl = new PollController;
		
		$view = $ctrl->show($poll->id)->getData();
		$this->assertTrue(str_contains($view['poll'], $poll->toimikunta));
	}

	public function testEdit() {
		$poll_ctrl = new PollController;
		$this->assertNull($poll_ctrl->edit(1));
	}
	
	public function testUpdate() {
		$this->fakeLogin();
		$this->mockPoll()->save();

		$poll = Poll::find(43);

		$poll_ctrl = new PollController;
		Request::replace($input=['toimikunta'=>'bricks']);
		$poll_ctrl->update(43);

		$poll = Poll::find(43);
		$this->assertEquals('bricks', $poll->toimikunta);
	}

	public function testUpdateIsOpen() {
		$this->fakeLogin();
		$this->mockPoll()->save();

		$poll = Poll::find(43);
		$this->assertEquals(1, $poll->is_open);

		$poll_ctrl = new PollController;
		Request::replace($input=['is_open'=>false]);
		$poll_ctrl->update(43);

		$poll = Poll::find(43);
		$this->assertEquals(0, $poll->is_open);
	}

	public function testDestroy() {
		$poll_ctrl = new PollController;
		$this->assertNull($poll_ctrl->destroy(1));
	}
}