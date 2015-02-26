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
	}

	private function brew_an_admin() {
		return $params = ['id' => 123, 'first_name' => 'first', 'last_name' => 'last', 'department' => 'deb', 'position' => 'pos', 'username' => 'user', 'is_admin' => 1];
	}

	private function brew_a_user() {
		return $params = ['id' => 42, 'first_name' => 'f', 'last_name' => 'l', 'department' => 'deb', 'position' => 'pos', 'username' => 'usr'];
	}

	private function brew_an_answer() {
		return $params = ['id' => 8, 'participant_id' => 99, 'timeidea_id'=>99, 'sopivuus' => 'sopii'];
	}

	private function brew_a_poll() {
		return ['id' => 43, 'toimikunta' => 'committee', 'is_open' => 1];
	}

	private function brew_an_idea() {
		return ['id' => 23, 'poll_id' => 1, 'description' => 'Stay awhile and listen'];
	}

	private function brew_a_committee() {
		return ['id' => 1, 'name' => 'committee', 'time' => 'default'];
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

	//yleistä solvaamista
	public function generalMockery($model, $params = array()) {
		foreach($params as $key => $value) {
			$model->$key = $value;
		}
		return $model;
	}

	public function fakeLogin() {
		$this->mockUser($this->brew_an_admin())->save();
		$login_ctrl = new LoginController;
		Request::replace($input=['username'=>'user']);
		$login_ctrl->doLogin();
	}
}
