<?php

class UserControllerTest extends TestCase {

	public function getIndex() {
		Event::all();
		return "moi";
	}

	public function testIndex() {
		Event::shouldReceive('all')
			 ->once();

		$this->call('GET', 'pooli');

		$this->assertViewHas('users');
	}
}