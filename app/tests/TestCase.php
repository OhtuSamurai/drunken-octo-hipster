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

	private function brew_a_user() {
		return $params = ['id' => 42, 'first_name' => 'f', 'last_name' => 'l', 'department' => 'deb', 'position' => 'pos', 'username' => 'usr'];
	}


	private function brew_a_committee() {
		return ['id' => 1, 'name' => 'committee', 'time' => 'default'];
	}

	public function mockUser($params = array()) {
		if(empty($params)) $params = $this->brew_a_user();
		return $this->generalMockery(new User, $params);
	}

	public function mockPoll($id) {
		$poll = new Poll;
		$poll->toimikunta = "testi";
		$poll->is_open=1;
		$poll->id=$id;		
		return $poll;
	}

	public function mockTimeidea($id, $pid) {
		$idea = new Timeidea;
		$idea->id=$id;
		$idea->poll_id=$pid;
		$idea->description="testi";
		return $idea;
	}

	public function mockAnswer($id, $uid, $tid) {
		$ans = new Answer;
		$ans->id=$id;
		$ans->participant_id=$uid;
		$ans->timeidea_id=$tid;
		$ans->sopivuus="sopii";
		return $ans;
	}

	public function mockCommittee($params = array()) {
		if(empty($params)) $params = $this->brew_a_committee();
		return $this->generalMockery(new Committee, $params);
	}

	public function generalMockery($model, $params = array()) {
		foreach($params as $key => $value) {
			$model->$key = $value;
		}
		return $model;
	}
}
