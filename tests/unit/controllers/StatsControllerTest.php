<?php

class StatsControllerTest extends TestCase {
	public function testIndexNotLoggedIn() {
		$this->action('GET', 'StatsController@index');
		$this->assertRedirectedTo('/');
		$this->assertSessionHasErrors();
	}

	public function testIndexAsUser() {
		$this->fakeLoginUser();
		$this->testIndexNotLoggedIn();
	}

	public function testIndex() {
		$this->fakeLoginAdmin();
		$this->action('GET', 'StatsController@index');
		$this->assertResponseOk();
	}
}