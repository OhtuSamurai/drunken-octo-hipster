<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

	/**
	 * Creates the application.
	 *
	 * @return \Symfony\Component\HttpKernel\HttpKernelInterface
	 */
	public function createApplication()
	{
		$unitTesting = true;

		$testEnvironment = 'testing';

		return require __DIR__.'/../../bootstrap/start.php';
	}
	private function prepareForTests() {
		Artisan::call('migrate');
	}

	public function setUp() {
    		parent::setUp(); // Don't forget this!
    		$this->prepareForTests();
    		Session::start();
    		Route::enableFilters();
	}

	private function brew_an_admin() {
		return $params = ['id' => 123, 'first_name' => 'first', 'last_name' => 'last', 'department' => 'deb', 'position' => 'pos', 'username' => 'user', 'is_admin' => 1, 'is_active' => 1];
	}

	private function brew_a_user() {
		return $params = ['id' => 42, 'first_name' => 'f', 'last_name' => 'l', 'department' => 'deb', 'position' => 'pos', 'username' => 'usr', 'is_active' => 1];
	}

	private function brew_an_answer() {
		return $params = ['id' => 8, 'participant_id' => 99, 'timeidea_id'=>99, 'sopivuus' => 'sopii'];
	}

	private function brew_a_comment() {
		return ['id'=>12,'commenttext'=>'Ebin juttu XD','poll_id'=>'uniikki','user_id'=>42];
	}

	private function brew_a_poll() {
		return ['id' => 'uniikki', 'toimikunta' => 'committee', 'is_open' => 1];
	}

	private function brew_an_idea() {
		return ['id' => 23, 'poll_id' => 'uniikki', 'description' => 'Stay awhile and listen'];
	}

	private function brew_a_committee() {
		return ['id' => 1, 'name' => 'committee', 'time' => 'default', 'is_open' => 1];
	}

	private function brew_a_lurker() {
		return ['id' => 314, 'name' => 'lurker', 'poll_id' => 'uniikki'];
	}

	private function brew_an_attachment() {
		return ['id'=>255,'file'=>base_path().'/tests/attachments/1/asdf','committee_id'=>1,'filename'=>'asdf'];
	}

	private function brew_a_destroyable() {
		return ['id'=>255,'file'=>'/los_ebun/1/asdf','committee_id'=>1,'filename'=>'asdf'];
	}

	public function mockDestroyableAttachment() {
		$params = $this->brew_a_destroyable();
		return $this->generalMockery(new Attachment, $params);
	}

	public function mockAttachment() {
		$params = $this->brew_an_attachment();
		return $this->generalMockery(new Attachment, $params);
	}

	public function mockUserWithId($id) {
		$params = $this->brew_a_user();
		$params['id'] = $id;
		return $this->generalMockery(new User, $params);
	}

	public function mockComment() {
		$params = $this->brew_a_comment();
		return $this->generalMockery(new Comment,$params);
	}

	public function mockUser($params = array()) {
		if(empty($params)) $params = $this->brew_a_user();
		return $this->generalMockery(new User, $params);
	}

	public function mockPoll($params = array()) {
		if(empty($params)) $params = $this->brew_a_poll();
		return $this->generalMockery(new Poll, $params);
	}

	public function mockTimeidea($params = array()) {
		if(empty($params)) $params = $this->brew_an_idea();
		return $this->generalMockery(new Timeidea, $params);
	}

	public function mockAnswer($params = array()) {
		if(empty($params)) $params = $this->brew_an_answer();
		return $this->generalMockery(new Answer, $params);
	}

	public function mockCommittee($params = array()) {
		if(empty($params)) $params = $this->brew_a_committee();
		return $this->generalMockery(new Committee, $params);
	}

	public function mockLurker($params = array()) {
		if(empty($params)) $params = $this->brew_a_lurker();
		return $this->generalMockery(new Lurker, $params);
	}

	//yleistä solvaamista
	public function generalMockery($model, $params = array()) {
		foreach($params as $key => $value) {
			$model->$key = $value;
		}
		return $model;
	}

	public function fakeLogin($user) {
		$login_ctrl = new LoginController;
		Request::replace($input=['username'=>$user->username]);
		$login_ctrl->login();
	}

	public function fakeLoginUser() {
		$user = $this->mockUser($this->brew_a_user());
		$user->save();	
		$this->fakeLogin($user);
	}

	public function fakeLoginAdmin() {
		$user = $this->mockUser($this->brew_an_admin());
		$user->save();
		$this->fakeLogin($user);
	}
}
