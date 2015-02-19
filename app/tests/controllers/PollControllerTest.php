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
		$u51 = $this->mockUser();
		$u51->id = 51;
		$u51->save();
		
		$u52 = $this->mockUser();
		$u52->id = 52;
		$u52->save();
		
		$u53 = $this->mockUser();
		$u53->id = 53;
		$u53->save();
		
		$a = new PollController;
		Request::replace($input=['toimikunta'=>'Hieno Toimikunta', 'user'=>[51, 52]]);
		$a->Store();
		$poll = Poll::find(1);
		$this->assertEquals(1, $poll->is_open);
		$this->assertTrue($poll->toimikunta=='Hieno Toimikunta');
		$this->assertTrue($poll->users()->get()->contains(51));
		$this->assertTrue($poll->users()->get()->contains(52));
		$this->assertFalse($poll->users()->get()->contains(53));
	}
	
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
	
	public function testUpdate() {
		$this->mockPoll(74)->save();

		$poll = Poll::find(74);
		$this->assertEquals(1, $poll->is_open);

		$a = new PollController;
		Request::replace($input=['is_open'=>false]);
		$a->update(74);

		$poll = Poll::find(74);
		$this->assertEquals(0, $poll->is_open);
	}

	public function testDestroy() {
		$a = new PollController;
		$this->assertNull($a->destroy(1));
	}
}