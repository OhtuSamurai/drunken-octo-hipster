<?php

class AdminControllerTest extends TestCase {

	public function testShowAdminPage() {
		$response = $this->action('GET', 'AdminController@showAdminPage');

		$view = $response->original;
		$a = new AdminController;
		$this->assertEquals($a->showAdminPage(), $view );
	}
}