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

	public function mockUser($id) {
		$usr = new User;
		$usr->id=$id;
		$usr->first_name="general name";
		$usr->last_name="even more general name";
		$usr->department="mock department";
		$usr->position="very important position";
		$usr->username="username";
		return $usr;
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
		$idea->date="2015-01-01";
		$idea->begins="10:00:00.000";
		$idea->ends="11:00:00.000";
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
}
