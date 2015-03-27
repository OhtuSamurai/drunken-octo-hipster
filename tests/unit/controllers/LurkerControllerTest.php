<?php

class LurkerControllerTest extends TestCase {
	public function testStoreAsNotLoggedIn()
	{
		$this->mockPoll()->save();
		$this->action('POST', 'LurkerController@store', [], ['poll_id' => 43]);
		$this->assertRedirectedToAction('PollController@edit', ['id' => 43]);
		$this->assertSessionHasErrors();
	}

	public function testStoreAsLoggedIn()
	{
		$this->fakeLoginUser();
		$this->testStoreAsNotLoggedIn();	
	}

	public function testStoreInputMissingName()
	{
		$this->fakeLoginAdmin();
		$this->testStoreAsNotLoggedIn();
	}

	public function testStore()
	{
		$this->fakeLoginAdmin();
		$this->mockPoll()->save();
		$this->mockTimeidea()->save();
		$this->action('POST', 'LurkerController@store', [], ['name' => 'lurkah','poll_id' => 43]);
		$this->assertRedirectedToAction('PollController@edit', ['id' => 43]);
		$this->assertEquals('lurkah', Lurker::find(1)->name);
		$this->assertEquals(Poll::find(43)->lurkers()->first()->name, Lurker::find(1)->name);
	}
}