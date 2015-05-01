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
		$this->action('POST', 'CommitteeController@store', null, ['name'=>'uusi uljas toimikunta', 'time'=>'nyt', 'department' => 'laitos', 'role' => 'suuri johtaja', 'user' => [$user->id]]);
		$this->assertRedirectedToAction('CommitteeController@show', ['id' => 1]);
		$committee = Committee::find(1);
		$this->assertEquals('uusi uljas toimikunta', $committee->name);
		$this->assertEquals('nyt', $committee->time);
		$this->assertTrue($committee->users()->get()->contains($user->id));
	}

	public function testShowWithMemberUser() {
		$this->fakeLoginUser();
		$this->mockCommittee()->save();
		$usr = User::find(42);
		$com = Committee::find(1);
		$com->users()->attach($usr);
		$this->action('GET', 'CommitteeController@show', ['id' => 1]);
		$this->assertViewHas('committee');
		$this->assertViewHas('users');
		$this->assertViewHas('showFiles', true);
	}

	public function testShowWithFile() {
		$this->fakeLoginUser();
		$this->mockCommittee()->save();
		$this->mockAttachment()->save();
		$usr = User::find(42);
		$com = Committee::find(1);
		$com->users()->attach($usr);
		$this->action('GET', 'CommitteeController@show', ['id' => 1]);
		$this->assertViewHas('committee');
		$this->assertViewHas('users');
		$this->assertViewHas('showFiles', true);
	}

	public function testShowUpdateAttachments() {
		$this->fakeLoginUser();
		$this->mockCommittee()->save();
		$this->mockAttachment(['id'=>256,'file'=>null,'committee_id'=>1,'filename'=>'gerogerigegege'])->save();
		$usr = User::find(42);
		$com = Committee::find(1);
		$com->users()->attach($usr);
		$this->action('GET', 'CommitteeController@show', ['id' => 1]);
		$this->assertViewHas('committee');
		$this->assertViewHas('users');
		$this->assertViewHas('showFiles', true);
	}

	public function testShowWithNonMemberUser() {
		$this->fakeLoginUser();
		$this->mockUserWithId(82)->save();
		$this->mockCommittee()->save();
		$usr = User::find(82);
		$com = Committee::find(1);
		$com->users()->attach($usr);
		$this->action('GET', 'CommitteeController@show', ['id' => 1]);
		$this->assertViewHas('committee');
		$this->assertViewHas('users');
		$this->assertViewHas('showFiles', false);
	}

	public function testShowAsNotLoggedIn() {
		$this->mockCommittee()->save();
		$this->action('GET', 'CommitteeController@show', ['id' => 1]);
		$this->assertViewHas('committee');
		$this->assertViewHas('users');
		$this->assertViewHas('showFiles', false);
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

	public function testEditAsNotLoggedIn() {
		$this->mockCommittee()->save();
		$this->action('GET', 'CommitteeController@edit', ['id' => 1]);
		$this->assertRedirectedTo('/');
		$this->assertSessionHasErrors();
	}

	public function testEditAsRegularUser() {
		$this->fakeLoginUser();
		$this->testEditAsNotLoggedIn();
	}

	public function testEdit() {
		$this->fakeLoginAdmin();
		$this->mockCommittee()->save();
		$this->action('GET', 'CommitteeController@edit', ['id' => 1]);
		$this->assertResponseOk();
		$this->assertViewHas('committee');
	}

	public function testUpdateAsNotLoggedIn() {
		$this->mockCommittee()->save();
		$this->action('PUT', 'CommitteeController@update', ['id' => 1], ['name' => 'hassu nimi']);
		$this->assertRedirectedToAction('CommitteeController@show', ['id' => 1]);
		$this->assertSessionHasErrors();
		$this->assertEquals('committee', Committee::find(1)->name);
		$this->assertFalse(Committee::find(1)->name == 'hassu nimi');
	}

	public function testUpdateAsRegularUser() {
		$this->fakeLoginUser();
		$this->testUpdateAsNotLoggedIn();
	}

	public function testUpdateOneField() {
		$this->fakeLoginAdmin();
		$this->mockCommittee()->save();
		$this->action('PUT', 'CommitteeController@update', ['id' => 1], ['name' => 'hassu nimi']);
		$this->assertRedirectedToAction('CommitteeController@edit', ['id' => 1]);
		$this->assertEquals('hassu nimi', Committee::find(1)->name);
	}

	public function testUpdate() {
		$this->fakeLoginAdmin();
		$this->mockCommittee()->save();
		$this->action('PUT', 'CommitteeController@update', ['id' => 1], ['name' => 'hassu nimi', 'time' => 'new time', 'description' => 'new', 'department' => 'Fysiikan laitos', 'role' => 'Professori']);
		$this->assertRedirectedToAction('CommitteeController@edit', ['id' => 1]);
		$this->assertEquals('hassu nimi', Committee::find(1)->name);
		$this->assertEquals('new time', Committee::find(1)->time);
		$this->assertEquals('new', Committee::find(1)->description);
		$this->assertEquals('Professori', Committee::find(1)->role);
		$this->assertEquals('Fysiikan laitos', Committee::find(1)->department);
	}

	public function testDestroy() {
		$com_ctrl = new CommitteeController;
		$this->assertNull($com_ctrl->destroy(1));
	}
}