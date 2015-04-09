<?php

class LurkerControllerTest extends TestCase {
	public function testStoreAsNotLoggedIn()
	{
		$this->mockPoll()->save();
		$this->action('POST', 'LurkerController@store', [], ['poll_id' => 'uniikki']);
		$this->assertRedirectedToAction('PollController@edit', ['id' => 'uniikki']);
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
		$this->action('POST', 'LurkerController@store', [], ['name' => 'lurkah','poll_id' => 'uniikki']);
		$this->assertRedirectedToAction('PollController@edit', ['id' => 'uniikki']);
		$this->assertEquals('lurkah', Lurker::find(1)->name);
		$this->assertEquals(Poll::find('uniikki')->lurkers()->first()->name, Lurker::find(1)->name);
	}

	public function testDestroyPoistaaTietokannasta() {
		$this->fakeLoginAdmin();
		$lurk = $this->mockLurker();		
		$lurk->save();
		$poll = $this->mockPoll();
		$poll->save();
		$this->action('delete', 'LurkerController@destroy',['lurker_id'=>$lurk->id,'poll_id'=>$poll->id]); 		
		$this->assertTrue(Lurker::find($lurk->id)==NULL);	
	}
}
