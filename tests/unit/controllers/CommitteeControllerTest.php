<?php

class CommitteeControllerTest extends TestCase {

	public function testIndex() {
		$this->action('GET', 'CommitteeController@index');
		$this->assertResponseOk();
		$this->assertViewHas('committees');
	}

	public function testCreateNotLoggedin() {
		$this->action('GET', 'CommitteeController@create');
		$this->assertRedirectedTo('/');
		$this->assertSessionHasErrors();
	}

	public function testCreate() {
		$this->fakeLoginAdmin();
		$this->mockUser()->save();
		$this->action('GET', 'CommitteeController@create');
		$users = User::where('is_active', '=', true)->get();
		$this->assertTrue($users->contains(42));
		$this->assertViewHas('users', $users);
	}

	public function testStoreNotLoggedin() {
		$this->action('POST', 'CommitteeController@store');
		$this->assertRedirectedTo('/');
		$this->assertSessionHasErrors();
	}

	public function testStoreLoggedInAsRegularUser() {
		$this->fakeLoginUser();
		$this->testStoreNotLoggedin();	
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
		$this->action('POST', 'CommitteeController@store', null, ['name'=>'uusi uljas toimikunta', 'time'=>'nyt', 'user' => [$user->id]]);
		$this->assertRedirectedToAction('CommitteeController@show', ['id' => 1]);
		$committee = Committee::find(1);
		$this->assertEquals('uusi uljas toimikunta', $committee->name);
		$this->assertEquals('nyt', $committee->time);
		$this->assertTrue($committee->users()->get()->contains($user->id));
	}

	public function testShow() {
		$this->mockCommittee()->save();
		$this->action('GET', 'CommitteeController@show', ['id' => 1]);
		$this->assertViewHas('committee');
		$this->assertViewHas('users');
	}

	public function testToggleDoesntWorkWhenNotLoggedIn() {
		$this->action('POST', 'CommitteeController@toggleOpen', ['id' => 1]);
		$this->assertRedirectedTo('/');
		$this->assertSessionHasErrors();
	}

	public function testToggleDoesntWorkWhenLoggedInAsRegularUser() {
		$this->fakeLoginUser();
		$this->testToggleDoesntWorkWhenNotLoggedIn();
	}

	private function toggleHelper($com, $expected) {
		$this->action('POST', 'CommitteeController@toggleOpen', ['id' =>  $com->id]);
		$com = Committee::find($com->id);
		$this->assertEquals($expected, $com->is_open);
		$this->assertRedirectedToAction('CommitteeController@show', ['id' => $com->id]);
	}

	public function testToggleOpen_ClosingCommittee() {
		$this->fakeLoginAdmin();
		$com = $this->mockCommittee();
		$com->save();
		$this->toggleHelper($com, 0);
	}

	public function testToggleOpen_FirstCloseThenOpenCommittee() {
		$this->fakeLoginAdmin();
		$com = $this->mockCommittee();
		$com->save();
		$this->toggleHelper($com, 0);//closes
		$this->toggleHelper($com, 1);//opens 
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