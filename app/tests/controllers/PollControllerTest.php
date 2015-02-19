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

	public function testStore() {
		$a = new PollController;
		$params = ['id' => 42, 'first_name' => 'f', 'last_name' => 'l', 'department' => 'deb', 'position' => 'pos', 'username' => 'usr'];

		//luodaan userit ideillä 51,52,53
		for($i = 51; $i<54; $i++) {
			$params['id'] = $i;
			$this->mockUser($params)->save();
		}

		Request::replace($input=['toimikunta'=>'Hieno Toimikunta', 'user'=>[51, 52]]);
		$a->store();
		$poll = Poll::find(1);

		$this->assertEquals(1, $poll->is_open);
		$this->assertTrue($poll->toimikunta=='Hieno Toimikunta');
		$this->assertTrue($poll->users()->get()->contains(51));
		$this->assertTrue($poll->users()->get()->contains(52));
		$this->assertFalse($poll->users()->get()->contains(53));
	}
	
	public function testShow() {
		$this->mockPoll()->save();
		
		$p = Poll::find(43);
		$ctrl = new PollController;
		
		$view = $ctrl->show($p->id)->getData();
		$this->assertTrue(str_contains($view['poll'], $p->toimikunta));
	}

	public function testEdit() {
		$a = new PollController;
		$this->assertNull($a->edit(1));
	}
	
	public function testUpdate() {
		$this->mockPoll()->save();

		$poll = Poll::find(43);
		$this->assertEquals(1, $poll->is_open);

		$a = new PollController;
		Request::replace($input=['is_open'=>false]);
		$a->update(43);

		$poll = Poll::find(43);
		$this->assertEquals(0, $poll->is_open);
	}

	public function testDestroy() {
		$a = new PollController;
		$this->assertNull($a->destroy(1));
	}
}