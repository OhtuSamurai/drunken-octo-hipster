<?php

class CommitteeControllerTest extends TestCase {

	public function testIndex() {
		$response = $this->action('GET', 'CommitteeController@index');
		$view = $response->original;
		$com_ctrl = new CommitteeController;
		$this->assertEquals($com_ctrl->index(), $view );
	}

	public function testCreateNotLoggedin() {
		$com_ctrl = new CommitteeController;
		$this->assertNotNull($com_ctrl->create());
	}

	public function testCreate() {
		$this->fakeLoginAdmin();
		$ctrl = new CommitteeController;
		$this->assertNotNull($ctrl->create());
	}

	public function testStoreNotLoggedin() {
		$this->action('POST', 'CommitteeController@store');
		$this->assertRedirectedTo('/');
		$this->assertSessionHasErrors();
	}

	public function testStoreLoggedInAsRegularUser() {
		$this->fakeLoginUser();
		$this->action('POST', 'CommitteeController@store');
		$this->assertRedirectedTo('/');
		$this->assertSessionHasErrors();	
	}

	public function testStoreWithIncorrectInput() {
		$this->fakeLoginAdmin();
		$this->action('POST', 'CommitteeController@store');
		$this->assertRedirectedToAction('CommitteeController@create');
		$this->assertSessionHasErrors();
	}

	public function testStore() {
		$this->fakeLoginAdmin();
		$user = $this->mockUser();
		$user->save();

		Request::replace($input=['name'=>'uusi uljas toimikunta', 'time'=>'nyt', 'user' => [$user->id]]);

		$ctrl = new CommitteeController;
		$ctrl->store();

		$committee = Committee::find(1);
		$this->assertEquals('uusi uljas toimikunta', $committee->name);
		$this->assertEquals('nyt', $committee->time);
		$this->assertTrue($committee->users()->get()->contains($user->id));
	}

	public function testShow() {
		$this->mockCommittee()->save();
		
		$committee = Committee::find(1);
		$ctrl = new CommitteeController;
		
		$view = $ctrl->show($committee->id)->getData();
		$this->assertTrue(str_contains($view['committee'], $committee->name));
	}

	public function testCloseAsNotLoggedIn() {
		$this->action('POST', 'CommitteeController@close', ['id' => 1]);
		$this->assertRedirectedTo('/');
		$this->assertSessionHasErrors();
	}

	public function testCloseLoggedInAsRegularUser() {
		$this->fakeLoginUser();
		$this->action('POST', 'CommitteeController@close', ['id' => 1]);
		$this->assertRedirectedTo('/');
		$this->assertSessionHasErrors();
	}

	public function testClose() {
		
	}

	public function testOpenAsNotLoggedIn() {
		$com = $this->mockCommittee();
		$com->is_open = 0;
		$com->save();
		$this->action('POST', 'CommitteeController@open', ['id' => $com->id]);
		$this->assertRedirectedToAction('CommitteeController@show', ['id' => $com->id]);
		$this->assertSessionHasErrors();
	}

	public function testOpenLoggedInAsRegularUser() {
		$this->fakeLoginUser();
		$com = $this->mockCommittee();
		$com->is_open = 0;
		$com->save();
		$this->action('POST', 'CommitteeController@open', ['id' => $com->id]);
		$this->assertRedirectedToAction('CommitteeController@show', ['id' => $com->id]);
		$this->assertSessionHasErrors();
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